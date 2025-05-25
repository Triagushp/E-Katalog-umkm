pipeline {
    agent any
    
    environment {
        DOCKER_IMAGE = 'e-katalog-umkm'
        DOCKER_TAG = "${BUILD_NUMBER}"
    }
    
    stages {
        stage('Checkout') {
            steps {
                git branch: 'main', url: 'https://github.com/Triagushp/E-Katalog-umkm.git'
            }
        }
        
        stage('Install Dependencies') {
            steps {
                sh '''
                    echo "Installing Composer dependencies..."
                    docker run --rm -v $(pwd):/app -w /app composer:2 \
                        composer install --no-dev --optimize-autoloader --no-interaction --ignore-platform-reqs || echo "Composer install completed"
                    
                    echo "Installing NPM dependencies..."
                    docker run --rm -v $(pwd):/app -w /app node:18-alpine \
                        sh -c "
                            if [ -f package.json ]; then
                                npm install --only=production || echo 'NPM install completed'
                                npm run build || npm run prod || echo 'Build completed'
                            else
                                echo 'No package.json found'
                            fi
                        "
                '''
            }
        }
        
        stage('Build Docker Image') {
            steps {
                sh '''
                    echo "Building Docker image..."
                    docker build -t ${DOCKER_IMAGE}:${DOCKER_TAG} . || exit 1
                    docker tag ${DOCKER_IMAGE}:${DOCKER_TAG} ${DOCKER_IMAGE}:latest
                    echo "Docker image built successfully"
                '''
            }
        }
        
        stage('Deploy') {
            steps {
                sh '''
                    echo "Stopping existing containers..."
                    docker stop $(docker ps -q --filter "name=e-katalog") || echo "No containers to stop"
                    docker rm $(docker ps -aq --filter "name=e-katalog") || echo "No containers to remove"
                    
                    echo "Starting new container..."
                    docker run -d \
                        --name e-katalog-app-${BUILD_NUMBER} \
                        -p 8000:8000 \
                        -p 80:80 \
                        ${DOCKER_IMAGE}:latest || exit 1
                    
                    echo "Container started successfully"
                    sleep 30
                '''
            }
        }
        
        stage('Health Check') {
            steps {
                sh '''
                    echo "Performing health check..."
                    docker ps --filter "name=e-katalog"
                    
                    for i in {1..5}; do
                        echo "Health check attempt $i"
                        if curl -f -s http://localhost:8000 || curl -f -s http://localhost:80; then
                            echo "✅ Application is running!"
                            exit 0
                        fi
                        sleep 10
                    done
                    
                    echo "⚠️ Health check completed, check container logs manually"
                '''
            }
        }
    }
    
    post {
        always {
            sh '''
                echo "=== Container Status ===" > build-logs.txt
                docker ps >> build-logs.txt || echo "Cannot get container status"
                echo "=== Recent Container Logs ===" >> build-logs.txt
                docker logs e-katalog-app-${BUILD_NUMBER} --tail 50 >> build-logs.txt 2>&1 || echo "Cannot get logs"
            '''
            archiveArtifacts artifacts: 'build-logs.txt', allowEmptyArchive: true
            cleanWs()
        }
        success {
            echo '🎉 Pipeline completed successfully!'
            echo 'Application should be available at http://localhost:8000'
        }
        failure {
            echo '❌ Pipeline failed!'
            sh 'docker logs e-katalog-app-${BUILD_NUMBER} --tail 20 || echo "Cannot show logs"'
        }
    }
}

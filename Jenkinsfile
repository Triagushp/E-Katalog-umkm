pipeline {
    agent any
    
    environment {
        DOCKER_IMAGE = "my-laravel-app"
        DOCKER_TAG = "${BUILD_NUMBER}"
        PROJECT_PATH = "/home/deployer/projects/your-laravel-project"
    }
    
    stages {
        stage('Checkout') {
            steps {
                git branch: 'main', 
                    credentialsId: 'github-credentials',
                    url: 'https://github.com/username/repository-name.git'
            }
        }
        
        stage('Environment Setup') {
            steps {
                script {
                    // Copy .env file jika belum ada
                    sh """
                        cd ${PROJECT_PATH}
                        if [ ! -f .env ]; then
                            cp .env.example .env
                        fi
                    """
                }
            }
        }
        
        stage('Build Docker Image') {
            steps {
                script {
                    sh """
                        cd ${PROJECT_PATH}
                        docker build -t ${DOCKER_IMAGE}:${DOCKER_TAG} .
                        docker tag ${DOCKER_IMAGE}:${DOCKER_TAG} ${DOCKER_IMAGE}:latest
                    """
                }
            }
        }
        
        stage('Stop Old Containers') {
            steps {
                script {
                    sh """
                        cd ${PROJECT_PATH}
                        docker-compose down || true
                    """
                }
            }
        }
        
        stage('Deploy') {
            steps {
                script {
                    sh """
                        cd ${PROJECT_PATH}
                        docker-compose up -d --build
                    """
                }
            }
        }
        
        stage('Run Migrations') {
            steps {
                script {
                    // Wait for containers to be ready
                    sh "sleep 30"
                    
                    sh """
                        docker exec laravel_app php artisan migrate --force
                        docker exec laravel_app php artisan config:cache
                        docker exec laravel_app php artisan route:cache
                        docker exec laravel_app php artisan view:cache
                    """
                }
            }
        }
        
        stage('Health Check') {
            steps {
                script {
                    sh """
                        sleep 20
                        curl -f http://localhost:80 || exit 1
                    """
                }
            }
        }
        
        stage('Cleanup') {
            steps {
                script {
                    sh """
                        docker image prune -f
                        docker system prune -f
                    """
                }
            }
        }
    }
    
    post {
        always {
            cleanWs()
        }
        success {
            echo 'Deployment successful!'
        }
        failure {
            echo 'Deployment failed!'
        }
    }
}

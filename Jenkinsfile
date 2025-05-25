pipeline {
    agent any
    
    environment {
        DOCKER_IMAGE = 'e-katalog-umkm'
        DOCKER_TAG = "${BUILD_NUMBER}"
        GITHUB_REPO = 'https://github.com/Triagushp/E-Katalog-umkm.git'
    }
    
    stages {
        stage('Checkout') {
            steps {
                git branch: 'main', url: "${GITHUB_REPO}"
            }
        }
        
        stage('Install Dependencies') {
            steps {
                sh 'composer install --no-dev --optimize-autoloader'
                sh 'npm install'
                sh 'npm run build'
            }
        }
        
        stage('Run Tests') {
            steps {
                sh 'php artisan test'
            }
        }
        
        stage('Build Docker Image') {
            steps {
                sh "docker build -t ${DOCKER_IMAGE}:${DOCKER_TAG} ."
                sh "docker tag ${DOCKER_IMAGE}:${DOCKER_TAG} ${DOCKER_IMAGE}:latest"
            }
        }
        
        stage('Deploy') {
            steps {
                sh 'docker-compose down'
                sh 'docker-compose up -d --build'
                sh 'docker-compose exec -T app php artisan migrate --force'
                sh 'docker-compose exec -T app php artisan config:cache'
                sh 'docker-compose exec -T app php artisan route:cache'
                sh 'docker-compose exec -T app php artisan view:cache'
            }
        }
        
        stage('Health Check') {
            steps {
                sh 'sleep 30'
                sh 'curl -f http://localhost || exit 1'
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

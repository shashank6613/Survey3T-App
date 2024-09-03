pipeline {
    agent any

    environment {
        DOCKER_REGISTRY = 'shashank9928/tier-survey'
        FRONTEND_IMAGE = 'shashank9928/frontend:latest'
        BACKEND_IMAGE = 'shashank9928/backend:latest'
        AWS_REGION = 'us-east-1'
        DB_HOST = credentials('db-host')
        DB_USER = credentials('db-user')
        DB_PASSWORD = credentials('db-pass')
        DB_NAME = credentials('db-name')
        GIT_CREDENTIALS_ID = 'git-creds'
        DOCKER_CREDENTIALS_ID = 'dock-creds'
        LOG_FILE = 'build_and_deploy.log'
    }

    stages {
        stage('Checkout') {
            steps {
                script {
                    echo "Checking out code from Git..."
                    sh "git clone https://github.com/shashank6613/Tire-survey3T.git >> ${LOG_FILE} 2>&1"
                }
            }
        }

        stage('Build Docker Images') {
            steps {
                script {
                    echo "Building Docker images..."
                    sh "docker-compose build >> ${LOG_FILE} 2>&1"
                }
            }
        }

        stage('Push Docker Images') {
            steps {
                script {
                    echo "Pushing Docker images..."
                    docker.withRegistry('https://index.docker.io/v1/', "${DOCKER_CREDENTIALS_ID}") {
                        sh "docker-compose push >> ${LOG_FILE} 2>&1"
                    }
                }
            }
        }

        stage('Deploy Services') {
            steps {
                script {
                    echo "Deploying services..."
                    withEnv([
                        "DB_HOST=${DB_HOST}",
                        "DB_USER=${DB_USER}",
                        "DB_PASSWORD=${DB_PASSWORD}",
                        "DB_NAME=${DB_NAME}"
                    ]) {
                        sh "docker-compose up -d >> ${LOG_FILE} 2>&1"
                    }
                }
            }
        }
    }

    post {
        always {
            echo 'Archiving log file...'
            archiveArtifacts artifacts: "${LOG_FILE}", allowEmptyArchive: true
        }

        failure {
            echo 'Pipeline failed. Cleaning up Docker containers and images...'
            script {
                // Stop and remove containers created by Docker Compose
                sh '''
                docker-compose down || true
                docker system prune -af || true
                '''
            }
        }

        success {
            echo 'Deployment completed successfully!'
        }
    }
}


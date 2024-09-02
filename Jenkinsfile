pipeline {
    agent any

    environment {
        DOCKER_REGISTRY = 'shashank9928/tier-survey'
        FRONTEND_IMAGE = "${DOCKER_REGISTRY}/frontend:latest"
        BACKEND_IMAGE = "${DOCKER_REGISTRY}/backend:latest"
        AWS_REGION = 'us-east-1'
        DB_HOST = 'db_host'
        DB_USER = 'db-user'
        DB_PASSWORD = 'db-password'
        DB_NAME = 'db-name'
        GIT_CREDENTIALS_ID = 'git-creds'
        DOCKER_CREDENTIALS_ID = 'dock-creds'
    }

    stages {
        stage('Checkout') {
            steps {
                git( 
                    url: 'https://github.com/shashank6613/Tire-survey3T.git',
                    branch: 'main',
                    credentialsId: "${GIT_CREDENTIALS_ID}"
                )
            }
        }

        stage('Build Frontend Docker Image') {
            steps {
                script {
                    docker.build("${env.FRONTEND_IMAGE}", "frontend/")
                }
            }
        }

        stage('Build Backend Docker Image') {
            steps {
                script {
                    docker.build("${env.BACKEND_IMAGE}", "backend/")
                }
            }
        }

        stage('Push Docker Image') {
            steps {
                withDockerRegistry([credentialsId: "${DOCKER_CREDENTIAL_ID}", url: 'https://index.docker.io/v1/']) {
                    script {
                        docker.image("${env.FRONTEND_IMAGE}").push('latest')
                        docker.image("${env.BACKEND_IMAGE}").push('latest')
                    }
                }
            }
        }

        stage('Deploy Frontend') {
            steps {
                script {
                    // deployment command for frontend using Docker Compose 
                    sh 'docker run -d -p 80:80 --name frontend ${FRONTEND_IMAGE}'
                }
            }
        }

        stage('Deploy Backend') {
            steps {
                script {
                    // deployment command for backend using Docker Compose
                    sh 'docker run -d -p 8080:80 --name backend -e DB_HOST=${DB_HOST} -e DB_USER=${DB_USER} -e DB_PASSWORD=${DB_PASSWORD} -e DB_NAME=${DB_NAME} ${BACKEND_IMAGE}'
                }
            }
        }
    }

    post {
        success {
            echo 'Deployment completed successfully!'
        }

        failure {
            echo 'Deployment failed.'
        }
    }
}


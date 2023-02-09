#!/bin/bash
docker stop kioskdashboard.bisaai.id
docker rm kioskdashboard.bisaai.id
docker build -t strongpapazola/ubuntu:kioskdashboard.bisaai.id .
docker run -d -p 127.0.0.1:8100:443 --name kioskdashboard.bisaai.id --restart always strongpapazola/ubuntu:kioskdashboard.bisaai.id
docker push strongpapazola/ubuntu:kioskdashboard.bisaai.id

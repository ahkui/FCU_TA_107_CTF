FROM ubuntu:16.04

RUN apt-get update
RUN apt-get install nodejs npm python3 -y
RUN npm init -f
RUN npm install zombie@5.x --save-dev

RUN useradd -ms /bin/bash bot
USER bot
WORKDIR /home/bot

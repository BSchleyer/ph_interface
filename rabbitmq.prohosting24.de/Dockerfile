FROM rabbitmq:management

# Define environment variables.
ENV RABBITMQ_USER admin
ENV RABBITMQ_PASSWORD YOURPW
ENV RABBITMQ_PID_FILE /var/lib/rabbitmq/mnesia/rabbitmq

ADD init.sh /init.sh
RUN chmod +x /init.sh
EXPOSE 15672

# Define default command
CMD ["/init.sh"]
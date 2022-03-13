import logging

logging.basicConfig(
    filename='pythonAlarm.log',
    format='[%(levelname)s] - %(asctime)s - %(message)s',
    datefmt='%d/%m/%Y %I:%M:%S %p',
    encoding='utf-8',
    level=logging.DEBUG
)

logging.debug('This message should go to the log file')
logging.info('So should this')
logging.warning('And this, too')
logging.error('And non-ASCII stuff, too, like Øresund and Malmö')
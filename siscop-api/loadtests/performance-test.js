import { sleep, group } from 'k6';
import http from 'k6/http';

export let options = {
    thresholds: {
        http_req_duration: ['p(95)<500'], // 95 percent of response times must be below 500ms
    },
};

export default function () {
    http.batch([
        ['GET', `https://${ __ENV.SISCOP_HOSTNAME }/api/usuario`],
        ['GET', `https://${ __ENV.SISCOP_HOSTNAME }/api/instituicao`],
        ['GET', `https://${ __ENV.SISCOP_HOSTNAME }/api/funcionario`],
    ]);

    sleep(3);
}

# SisCop - Sistema de Controle de Presença


[![Build Status](https://www.siscop.com.br/imagens/logo.png)](https://www.siscop.com.br/)


# SisCoP 

  O Sistema de Controle de Presença (SisCoP) é um sistema para registro de presença que utiliza, além de usuário e senha, a face da pessoa que pretende registrar a presença como identificadores. Além disso a geolocalização também é registrada para identificação do local do registro. Para tanto, foram construidas quatro instâncias da aplicação, cada qual, realizando um controle ou tarefa específica:
  - sicop-api 
  - siscop-api-laravel
  - siscop-app
  - siscop-web
  <br>
  Todos os arquivos estão divididos em diretórios específicos dentro do presente repositório.

#  SisCoP-APP

  Desenvolvido para as duas principais plataformas (Android e iOS). Trata-se do aplicativo móvel que permite o registro da presença em ambas as plataformas (celulares ou tablets) 

  - Android e iOS
![app](https://www.siscop.com.br/imagens/app.png)
  
  O Aplicativo utiliza um modelo de Rede Neural MobileFaceNet

![processo](https://www.siscop.com.br/imagens/processo.png)

#  SisCoP-WEB

 Sistema para gerenciamento de informações das instituições e pessoas cadastradas. Apenas podem registrar ou fazer o registro pessoas ou instituições previamente cadastrada.

![web](https://www.siscop.com.br/imagens/web.png)

#  SisCoP-API

 Faz todo o gerenciamento e tratamento das operações e funcionalidades entre o APP e o Sistema Web. 

#  SisCoP-API-LARAVEL

 No lado do servidor, as APIs são tratadas e gerenciadas por este módulo (dentro do framework Laravel)

  
# Installation

 Siga as orientações presentes no arquivo install.pdf localizado na raiz do presente repositório.

<br><br>

### Software Registrado <br>
Software devidamente registrado junto ao INPI sob número: BR 51 2022 002733-0.<br>

<br><br>

Desenvolvido por: [Dilermando Piva Junior](mailto:piva.jr@fatec.sp.gov.br) e [Francisco de Assis Freitas](mailto:freitas.assis@gmail.com)<br>
**Projeto de pesquisa desenvolvido para livre utilização**

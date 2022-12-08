# SisCop Mobile

A aplicação mobile é o front do SisCop onde é realizado a marcação da presença através de uma interface simples

## Pré-Requisitos

Para você executar o projeto será necessário ter instalado os seguintes SDKs:

- Dart (>=2.17.0 <3.0.0)
- Flutter (Compatível com o Dart)
- Android SDK (Caso realize a compilação para Android)
- xCode (Caso realize a compilação para iOS)

## Execução

Como todo o desenvolvimento do app foi realizado em flutte, todas as IDEs tem um suporte legal e com isso toda a configuração acaba sendo realizada de forma intuítiva, mas caso você deseje fazer por linha de comando, siga os passos abaixo:

1. Execute o comando `pub get` para instalação das bibliotecas necessárias
2. Crie um arquivo na raiz do projeto com o nome de .env e configure a variável abaixo
    - ENDPOINT_URL - Url base da sua API, caso esteja executando local colocar a url de localhost do seu ambiente
    - SENTRY_DNS - Código do Sentry para identificação dos erros da aplicação
2. Após a instalação das libs, execute o comando `flutter run {PLATAFORMA}` lembrando que a **{PLATAFORMA}** pode ser **android** ou **ios**, alternando conforme a sua necessidade
3. Pronto, o app será lançado e estará pronto para uso 🚀🚀

Lembrando que é necessário a API estar online para o app conseguir se comunicar


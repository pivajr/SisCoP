## SisCop API

Projeto responsável pelo core do projeto onde está toda a lógica responsável para realizar a identificação de face e também a gestão do armazenamento dos dados obtidos pela aplicação

## Pré-requisitos

Caso você queira configurar local o projeto na sua própria máquina será necessário ter os requisitos abaixo

- PHP 8+
- Composer
- Banco de dados (Utilizamos o MySQL no projeto, porém pode ser utilizado qualquer outro que você tenha mais familiaridade)

Caso você deseje utilizar ambiente já configurado com o Docker, recomendo ler a documentação do [Laravel](https://laravel.com/docs/8.x#initial-configuration), que é o framework utilizado internamente


## Execução

1. Execute o comando `composer install` e com isso será instalado e configurado todas as dependências do projeto
2. Após a execução do comando de instalação execute o comando `php artisan serve` para subir o servidor de aplicação local
3. Pronto, o projeto está preparado para receber as requisições 🚀

## Documentação auxíliar

Como toda a API foi desenvolvida através do framework [Laravel](https://laravel.com/docs/8.x) recomendamos a leitura da documentação para conhecimento de todas as possibilidades e suporte que o framework da para auxílio do desenvolvimento focado mais na implementação de negócio

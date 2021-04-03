<h1 align="center"> Pulses Teste </h1>

<div align="center">
  <img alt="GitHub Language Count" src="https://img.shields.io/github/languages/count/vandermnt/pulses" />
  <img alt="GitHub Top Language" src="https://img.shields.io/github/languages/top/vandermnt/pulses" />
  <a href="https://www.linkedin.com/in/vanderson-mantovani/">
    <img src="https://img.shields.io/badge/LinkedIn-blue?style=flat&logo=linkedin&labelColor=blue" />
  </a>
</div>

<h1>🛠 Preparando Ambiente </h1>

<h3>❗ Requisitos </h3>

- <a href="https://www.php.net/manual/pt_BR/intro-whatis.php">PHP</a>
- <a href="https://laravel.com/">Laravel</a>
- <a href="https://vuejs.org/">VueJS</a>
- <a href="https://www.mysql.com/"> MySQL </a>

Temos dois projetos, um de back-end e um de front-end. 
Back-end é feito com <a href="https://www.php.net/manual/pt_BR/intro-whatis.php">PHP</a> agregado ao framework <a href="https://laravel.com/">Laravel</a>, já o front-end é feito com <a href="https://vuejs.org/">VueJS</a>.
<p>🔹Após clonar o back-end, baixe as depedências do Laravel:</p>

~~~html
composer install
~~~

<p>🔹Gere uma chave para o projeto:</p>

~~~html
php artisan key:generate
~~~

<p>🔹Importe os scripts que está na pasta <b>scripts-db</b>;</p>
<p>🔹Configure o arquivo .env (arquivo o qual é configurado as variáveis de ambiente); </p>
<p>🔹Starte a back-end com o comando:

~~~html
php artisan serve
~~~

<img src="api">

<p> Desde então temos nosso back-end startado, agora precisamos startar nosso front-end </p>
<p>🔹Clone o front-end;</p>
<p>🔹Baixa as depedências do projeto: </p>

~~~html
npm install
~~~

<p>🔹Starte o front-end com o comando:
  
~~~html
npm run server
~~~

<img src="front.gif">


<h1 align="center"> Pulses Teste </h1>

<div align="center">
  <img alt="GitHub Language Count" src="https://img.shields.io/github/languages/count/vandermnt/pulses" />
  <img alt="GitHub Top Language" src="https://img.shields.io/github/languages/top/vandermnt/pulses" />
  <a href="https://www.linkedin.com/in/vanderson-mantovani/">
    <img src="https://img.shields.io/badge/LinkedIn-blue?style=flat&logo=linkedin&labelColor=blue" />
  </a>
</div>

<h1>🛠 Preparando Ambiente </h1>

Temos dois projetos, um de back-end e um de front-end. 
Back-end é feito com PHP agregado ao framework Laravel, já o front-end é feito com VueJS.
<p>🔹Após clonar o back-end, baixe as depedências do Laravel:</p>
`composer install`
<p>🔹Gere uma chave para o projeto:</p>
`php artisan key:generate`
<p>🔹Importe os scripts que está na pasta <b>scripts-db</b>;</p>
<p>🔹Feito isso configure o arquivo .env com as credenciais do banco de dado; </p>
<p>🔹Starte a back-end com o comando:

`php artisan serve`

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


# Terms of Service


<h1 align=center>DOCUMENTACIO POSTGRESQL</h1>
<p align=center>
 <img src=https://user-images.githubusercontent.com/91245889/194284311-1123f0ac-01c0-48b8-a92e-8fe4d6f5da8c.png>
</p>

## Taula de continguts
- [INSTALACIO](#instalacio)
- [FASE 0](#fase-0)
    - Requisits minims
- [FASE 1](#fase-1)
    - Creates
    - Inserts
    - Selects Python
- [FASE 2](#fase-2)
    - Copies de seguretat
    - Deletes
    - Alters
    - Updates Python
    - Deletes Python


## Instalacio
Per a instalar el PostgreSQL, obrirem un terminal i executarem la següent comanda:
~~~
sudo apt-get install postgresql-14
~~~
Un cop executada la comanda, podem veure que comença la instal·lació.
<p align=center>
 <img src=https://user-images.githubusercontent.com/91245889/189872334-570ef3f7-40bf-4cb4-a168-202a844056eb.png>
</p>

Hi ha una comanda on podem veure si el servei de PostgreSQL es troba actiu:
~~~
service postgresql status
~~~
En la següent imatge podem veure com el servei es troba actiu.
<p align=center>
 <img src=https://user-images.githubusercontent.com/91245889/189872417-bf6f11c3-c925-4035-9aa2-d5b0d8201d3f.png>
</p>

Finalment, per comprovar que tot s'ha instal·lat correctament, accedirem a PostgreSQL amb l'usuari postgres.
~~~
sudo -u postgres psql
~~~
<p align=center>
 <img src=https://user-images.githubusercontent.com/91245889/189872495-ded020d2-1e5d-4826-9675-17f6aed644b8.png>
</p>

Un cop arribats fins aqui, ja ens trobem dintre del Sistema Gestor de Bases de Dades PostgreSQL i podem realitzar sentencies SQL.

## 2. Creació de base de dades

Primer que tot, crearem una base de dades amb el nom de "UF4riba". Molt important posar *;* al final de cada sentència per a que s'executi.
~~~
CREATE DATABASE UF4riba;
~~~
Aquest hauria de ser el resultat i ja tindriem la base de dades creada.
<p align=center>
 <img src=https://user-images.githubusercontent.com/91245889/189877297-bead8792-cec4-4f8a-ad51-05f039a46163.png>
</p>

Podem comprovar que s'ha creat correctament, amb la comanda que ens mostra totes les bases de dades que existeixen:
~~~
\l
~~~
Veiem que es troba en ultim lloc.
<p align=center>
 <img src=https://user-images.githubusercontent.com/91245889/189877420-f9bc2ff3-ac92-476f-9c55-0945ba9d2311.png>
</p>

Ara crearem un usuari on despres li donarem tots els privilegis de la taula que hem creat abans (UF4riba). Posarem com a nom d'usuari *riba* i com a contrasenya *1234*.

~~~
CREATE USER riba WITH PASSWORD '1234';
~~~
<p align=center>
 <img src=https://user-images.githubusercontent.com/91245889/189877493-c3e1bbc7-2ede-4a1f-8343-e7e1b8ad41ef.png>
</p>

Finalment donariem permisos a l'usuari creat per a la Base de Dades.
~~~
GRANT ALL PRIVILEGES ON DATABSE UF4riba TO riba;
~~~
<p align=center>
 <img src=https://user-images.githubusercontent.com/91245889/189877464-4f61d308-f102-40a2-81f8-ee8829b882bd.png>
</p>

Ja hauriem creat una Base de Dades amb un usuari amb tots els permisos necessaris per a explotar la taula.

## Fase 0
Per a poder fer aquesta activitat s'ha de tenir instalat el PostgreSQL i el Python. Ho podem fer amb la seguent comanda:
Postgre:
~~~
psql -V
~~~
<p align=center>
 <img src=https://user-images.githubusercontent.com/91245889/192845944-b274f0cc-db51-4ddd-854e-1cb372ad443e.png>
<p/> 

Python:
~~~
python3 -v
~~~
<p align=center>
 <img src=https://user-images.githubusercontent.com/91245889/192845999-6f80eba6-f7bf-4377-90a1-23a1e2b3a412.png>
<p/> 
Ja tindriem tot el necessari per a poder fer la practica

## Fase 1

* ### Entrar al gestor Postgre
Per a entrar al gestor Postgre ho fem al la comanda:
~~~
sudo -u postgres psql
~~~
<p align=center>
<img src=https://user-images.githubusercontent.com/91245889/192812494-a61889c6-4bd4-4c1c-abdf-3f476dcbb603.png>
</p>

Ja estariem dintre

**IMPORTANT**: Tenir algun usuari amb permisos de SUPERUSUARI:
~~~
ALTER USER nomUsuari WITH SUPERUSER;
~~~
<p align=center>
  <img src=https://user-images.githubusercontent.com/91245889/193115916-c33429ca-fe9d-4d6e-b57e-a3b9eca14836.png>
</p>

* ### Crear una base de dades anomenada uf4JRF
Crearem la BD amb el nom indicat:
~~~
CREATE DATABASE nomBaseDeDades;
~~~
<p align=center>
 <img src=https://user-images.githubusercontent.com/91245889/192812944-e4e0c25f-fc26-4885-af98-7f366bbc6b8f.png>
</p>

La base de dades ja esta creada i finalment, entrem:
~~~
\c nomBD
~~~
<p align=center>
 <img src=https://user-images.githubusercontent.com/91245889/192814367-a479681a-a718-41cd-8293-0cc41cd7bd8c.png>
</p>

Ja hem entrat dintre

* ### Crear una taula anomenada estatsjrf amb els camps ID, nom i superficie

Per a crear taules ho farem indicant el nom de la taula amb els camps que contindra la taula i el tipus de dades

~~~
CREATE TABLE nomtaula (camp tipusCamp, camp2 tipusCamp2,...);
~~~
Creem la taula Estats:

<p align=center>
 <img src=https://user-images.githubusercontent.com/91245889/192815548-e49bf4d1-5aca-43a3-90bd-9048e6ccae9a.png>
</p>

* ### Crear una taula anomenada ciutatsjrf amb els camps ID, nom, habitants i estat
Creem la taula Ciutats amb la comanda anterior:

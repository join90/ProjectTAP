# Relazione del progetto di Technologies for Advanced Programming 

Autori del progetto:
* Salvo Ucchino (backend + parte logica)
* Giovanni Guerrieri (backend + parte logica)
* Dario Licciardello (frontend)

Il progetto è stato realizzato con il framework php di laravel utilizzando i servizi dell'architettura di Microsoft Azure. 

## Introduzione

L'idea del progetto riguarda un gestionale per fruttivendoli, allo scopo di facilitare l'utente nel localizzare (anche mediante una mappa) il negozio più vicino. E' possibile anche visualizzare in base ai filtri applicati, i prodotti relativi ad un negozio specifico. Se l'utente è un venditore, ha l'accesso ad un'area riservata dove può eseguire le seguenti operazioni: 

* creare un negozio; 
* aggiornare un negozio; 
* inserire un prodotto;
* aggiornare un prodotto.

L'applicazione utilizza i servizi di Microsoft Azure per svolgere le operazioni specificate in questo paragrafo.

## Architettura Azure
<p align="left"><img src="https://s24.postimg.org/f0v65nt51/project_architecture.png"></p>

## Descrizione del Progetto
Il progetto si suddivide in due parti: il frontend e il backend. 
Il frontend è stato implementato in modo da indirizzare le richieste degli utenti non venditori verso il servizio "Redis Cache", mentre per il backend le richieste vengono indirizzate al servizio MySQL. Il motivo di questa suddivisione consiste nel cercare di alleggerire il carico di lavoro nel server che ospita il servizio MySQL, e di conseguenza ottenere le risorse nel minor tempo possibile. Per permettere a Redis di sincronizzarsi con il servizio MySQL, è stato implementato un JoB tramite il servizio "WebJobs" che sta all'interno degli strumenti della WebApp.  

<p align="left"><img src="https://s1.postimg.org/wqmsw8ulb/image_2017-06-22_15-26-08.png"</p>

All'interno del "WebJobs" viene caricato un file bach con all'interno il comando di laravel: 

**php %HOME%\site\artisan schedule:run** .

Questo comando avvia lo scheduler di laravel che fa partire il sync su Redis per le risorse che risiedono nel database MySQL.
<p align="left"><img src="https://s22.postimg.org/wrqh9yp1t/updateredis.png"</p>

Redis viene usato non solo per la cache delle risorse, ma anche per la gestione delle "session".  
Un esempio che ci consente di interagire con Redis è la funzione "scan". Questa funzione risiede nella classe "RedisController" e ci consente tramite un pattern, di restituire un sottoinsieme di chiavi. Infine, mediante un ciclo vengono ottenute le risorse tramite la funzione "get". 

<p align="left"><img src="https://s9.postimg.org/tnn851w8v/image_2017-06-22_15-36-15.png"</p>

Per il backend sono stati creati dei controller per la gestione dei prodotti e dei negozi tramite le operazioni CRUD:
* create
* read
* update
* delete

Un altro servizio di Azure che è stato usato per la gestione delle immagini è il "Blob Storage". Per usufruire di questo servizio, sono state caricate su laravel le API di Microsoft. Quest'ultime vengono richiamate all'interno di una classe chiamata "BlobController" per la creazione o il download dei blob. Infine sono stati creati due container (prodotti e negozi) dove all'interno vengono inseriti i blob opportuni.  

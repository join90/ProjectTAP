# Relazione del progetto di Technologies for Advanced Programming 

Autori del progetto:
* Salvo Ucchino
* Giovanni Guerrieri
* Dario Licciardello

Il progetto è stato realizzato con il framework php di laravel utilizzando i servizi dell'architettura di Microsoft Azure. 

## Introduzione

L'idea del progetto riguarda un gestionale per fruttivendoli, allo scopo di facilitare l'utente nel localizzare (anche mediante una mappa) il negozio più vicino. E' possibile anche visualizzare in base ai filtri applicati, i prodotti relativi ad un negozio specifico. Se l'utente è un venditore, ha l'accesso ad un'area riservata dove può eseguire le seguenti operazioni: 

* creare un negozio; 
* aggiornare un negozio; 
* inserire un prodotto;
* aggiornare un prodotto.

L'applicazione utilizza i servizi di Microsoft Azure per svolgere le operazioni specificate in questo paragrafo.

# Architettura Azure

## Descrizione del Progetto

Il progetto si suddivide in due parti: il frontend e il backend. 
Il frontend è stato implementato in modo da indirizzare le richieste degli utenti non venditori verso il servizio "Redis Cache", mentre per il backend le richieste vengono indirizzate al servizio MySQL. Il motivo di questa suddivisione consiste nel cercare di alleggerire il carico di lavoro nel server che ospita il servizio MySQL, e di conseguenza ottenere le risorse nel minor tempo possibile. Per permettere a Redis di sincronizzarsi con il servizio MySQL, è stato implementato un JoB tramite il servizio "WebJobs" che sta all'interno degli strumenti della WebApp. 

Per il sync di Redis con MySql è stato creato un file bach con il comando di laravel: **php %HOME%\site\artisan schedule:run** .
 
<p align="center"><img src="https://postimg.org/image/ggqddncjx/"></p>

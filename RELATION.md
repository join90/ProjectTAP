# Relazione del progetto di Technologies for Advanced Programming 

Autori del progetto:
* Giovanni Guerrieri (backend - parte logica - architettura azure)
* Dario Licciardello (frontend - parte logica)
* Salvatore Ucchino (backend - parte logica - architettura azure)

Il progetto è stato realizzato utilizzando il framework php Laravel e i servizi cloud Azure messi a disposizione da Microsoft. 

## Introduzione
L'idea progettuale consiste nello sviluppo di un gestionale per fruttivendoli, allo scopo di facilitare l'utente nel localizzare (anche mediante una mappa) il negozio più vicino. E' possibile anche visualizzare in base ai filtri applicati, i prodotti relativi ad un negozio specifico. Se l'utente è un venditore, ha accesso ad un'area riservata dove può eseguire le seguenti operazioni: 

* creare un negozio
* aggiornare un negozio 
* inserire un prodotto
* aggiornare un prodotto

L'applicazione utilizza i servizi di Microsoft Azure per svolgere le operazioni specificate in questo paragrafo.

## Schema Architettura Azure
<p align="left"><img src="https://s24.postimg.org/f0v65nt51/project_architecture.png"></p>

<p align="left"><img src="https://s10.postimg.org/vy4llj9gp/Whats_App_Image_2017-06-23_at_09.37.33.jpg"></p>

## Descrizione del progetto e dei servizi utilizzati
Il progetto si suddivide in due parti: il frontend e il backend. 
Il frontend è stato implementato in modo da indirizzare le richieste degli utenti non venditori verso il servizio "Redis Cache", mentre per il backend le richieste vengono indirizzate al servizio MySQL. Il motivo di questa suddivisione consiste nel cercare di alleggerire il carico di lavoro nel server che ospita il servizio MySQL, e di conseguenza ottenere le risorse nel minor tempo possibile. Per permettere a Redis di sincronizzarsi con il servizio MySQL, è stato implementato un JoB tramite il servizio "WebJobs" che sta all'interno degli strumenti della WebApp.  

<p align="left"><img src="https://s1.postimg.org/wqmsw8ulb/image_2017-06-22_15-26-08.png"></p>

All'interno del "WebJobs" viene caricato un file bach con all'interno il comando di laravel: 

**php %HOME%\site\artisan schedule:run** .

Questo comando avvia lo scheduler di laravel che fa partire il sync su Redis per le risorse che risiedono nel database MySQL.
<p align="left"><img src="https://s22.postimg.org/wrqh9yp1t/updateredis.png"></p>

Redis viene usato non solo per la cache delle risorse, ma anche per la gestione delle "session".  
Un esempio che ci consente di interagire con Redis è la funzione "scan". Questa funzione risiede nella classe "RedisController" e ci consente tramite un pattern, di restituire un sottoinsieme di chiavi. Infine, mediante un ciclo vengono ottenute le risorse tramite la funzione "get". 

<p align="left"><img src="https://s9.postimg.org/tnn851w8v/image_2017-06-22_15-36-15.png"></p>

Un altro servizio di Azure che è stato usato per la gestione delle immagini è il "Blob Storage". Per usufruire di questo servizio, sono state caricate su laravel le API di Microsoft. Quest'ultime vengono richiamate all'interno di una classe chiamata "BlobController" per la creazione o il download dei blob. Infine sono stati creati due container (prodotti e negozi) dove all'interno vengono inseriti i blob opportuni.

## Backend

Il backend è un semplice pannello di amministrazione dove il venditore può gestire i suoi negozi e i suoi prodotti mediante le classiche operazioni CRUD (create, read, update, delete) sul database MySql.

[![Cattura1.png](https://s15.postimg.org/c0qn3h4jv/Cattura1.png)](https://postimg.org/image/g9vd5n7t3/)

[![Cattura2.png](https://s4.postimg.org/fifaoz319/Cattura2.png)](https://postimg.org/image/ynijyqhp5/)

[![Cattura3.png](https://s16.postimg.org/85vgvyqjp/Cattura3.png)](https://postimg.org/image/wz50wm9k1/)


### Le credenziali per accedere nel pannello amministrativo sono: 
### email: admin@email.it 
### password: 1234
Url: [Backend Websites](http://fastandfruit.azurewebsites.net/admin/dashboard)


## Frontend

URL homepage: [Azure Websites](http://fastandfruit.azurewebsites.net/users/home)

Il frontend si compone di una serie di semplici pagine web dinamiche e responsive che simulano il reale funzionamento di un portale di online shopping.

La barra di navigazione in alto consente di spostarsi facilmente tra le varie sottopagine. 

#### Pagina "Prodotti"

Viene mostrato l'elenco dei prodotti disponibili all'acquisto di tutti i rivenditori. La funzione "aggiungi al carrello" non è implementata ed è presente a solo scopo informativo.

#### Pagina "Mappa Rivenditori"

E' suddivisa in due parti, nella prima è possibile vedere i rivenditori affiliati al sito mentre nella seconda è presente una mappa realtime in cui vengono mostrate le relative posizioni geografiche. Cliccando sui marker viene visualizzato il nome del negozio.
Esempio di utilizzo di tale funzione potrebbe avvenire da parte cliente per trovare facilmente il rivenditore disponibile più vicino, qualora volesse andare di persona a prelevare i prodotti.
Per sapere quali prodotti vengono offerti dai rivenditori è sufficiente cliccare sulle rispettive voci nell'elenco in alto.

#### Pagina "Carrello"

Poichè il carrello non viene attivamente gestito in tale pagina viene proposto un semplice elenco generato dinamicamente con alcuni prodotti casuali, relative quantità e importi propriamente calcolati.
Anche in questo caso la funzione "procedi all'acquisto" è solamente indicativa.

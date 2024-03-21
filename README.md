## Esercizio di oggi: Laravel Glossario

### Descrizione: 
Andiamo a realizzare un programma per tenere traccia dei termini studiati (glossario). Oggi iniziamo un nuovo progetto che si arricchirà nel corso delle prossime lezioni: man mano aggiungeremo funzionalità e vedremo la nostra applicazione crescere ed evolvere.

Tramite questo progetto, mettiamo assieme tutto quanto visto finora di Laravel e aggiungiamo le relazioni.

Sarà quindi un esercizio incrementale: di giorno in giorno gli studenti dovranno integrare ciò che hanno visto la mattina a lezione.

L'esercitazione prevede:

1. Creazione diagramma E/R.

2. Creazione progetto Laravel 10.

3. Creazione di relative migrations.

4. Definizione issue: ricordatevi che è un lavoro di gruppo!

5. Aggiungiamo un nuovo model Word.

6. Autenticazione: si parte con l'autenticazione e la creazione di un layout per back-office. In questa fase, gestite anche la riorganizzazione eventuale di rotte, viste e via dicendo.

7. Per la parte di back-office creiamo un resource controller Admin\WordController per gestire le operazioni CRUD relative al glossario.

8. Aggiungiamo poi un nuovo model Link, con relativa migration. Creiamo quindi la relazione 1:n tra Word e Link (un termine può avere più link associati, un link può essere associato ad un solo termine), definendo la migration per aggiungere la foreign key alla tabella links e scrivendo le funzioni necessarie nei model. Aggiungiamo la selezione (e modifica) dei links associati al termine nelle CRUD e visualizziamo i links nella pagina show del termine.

9. Successivamente, creiamo un nuovo model Tag, con relativa migration. Creiamo quindi la relazione n:n tra Word e Tag, definendo la migration per creare la tabella ponte word_tag e scrivendo le funzioni necessarie nei model. Aggiungiamo la selezione (e modifica) dei tag associati al termine nelle CRUD e visualizziamo la lista di tag nella pagina show del termine.
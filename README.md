# SearchYourMovies
Progetto per il Laboratorio di Applicazioni Software e Sicurezza Informatica 2023
Il progetto riguarda lo sviluppo di una piattaforma di condivisione di opinioni tra utenti sui vari film, e la visualizzazione dei dettagli dei film stessi. Un utente può creare un profilo, aggiugnere film alla lista dei preferiti, lasciare recensioni e commenti su un film, e visualizzare le recensioni lasciate all'interno del suo profilo.


▪ Descrizione suddivisione attività tra i componenti del gruppo di lavoro:
Simone ha lavorato principalmente alla pagina dell’amministratore.
Natalia ha lavorato principalmente alla visualizzazione della pagina con i film, alla pagina dettagliata dei film,
login, registrazione, accesso tramite google, cambio password in caso l’utente se ne dimentichi, logout ed
eliminazione dell’account.
Alessandro ha lavorato principalmente sulla parte della creazione del profilo utente, alla visualizzazione
delle recensioni dei film e ai commenti che gli utenti vogliono lasciare sui film e all’inserimento dei film preferiti nel
profilo dell’utente e alla rimozione di essi.

User Stories:

• Utente:
1. Come utente voglio poter visualizzare la pagina iniziale con tutti i
film. (N)
2. Come utente, voglio cercare film per titolo in modo da scoprire i film. (N)
3. Come utente voglio poter modificare la visualizzazione dei film in base
alla popolarità oppure in ordine di data d’uscita. (N)
• Utente non registrato:
1. Come utente non registrato, voglio poter visualizzare la trama, il trailer e il
punteggio su TMDB. (N)
2. Come utente non registrato voglio poter fare il sign up (registrazione) attraverso
l’e-mail e la password così da diventare user. (N)
3. Come utente non registrato voglio fare il sign up attraverso google per
diventare user. (N)
• Utente registrato
1. Come utente, voglio salvare film tra i miei preferiti in modo da accedervi facilmente
e tener traccia dei film che mi interessano. (S)
2. Come utente, voglio vedere la mia lista dei film preferiti per visualizzare
rapidamente i film che ho contrassegnato come preferiti. (S)
3. Come utente, voglio poter fare il sign in per poter accedere alle sezioni speciali
della pagina (lista dei preferiti) (N)
4. Come utente, voglio poter essere in grado di togliere singolarmente un solo film
dalla mia lista dei preferiti. (S)
5. Come utente, voglio poter togliere tutti i film contemporaneamente dalla mia lista
dei preferiti. (S)
6. Come utente, voglio poter reimpostare la mia password in caso la dimentichi. (N)
7. Come utente, voglio poter visualizzare le recensioni che ho lasciato in precedenza sulla
mia pagina profilo. (A)
8. Come utente, desidero avere delle impostazioni utente in modo da poter eliminare
il mio account. (N)
9. Come utente, desidero avere delle impostazioni utente in modo da poter cambiare
la mia e-mail. (A)
10. Come utente, desidero avere delle impostazioni utente in modo da poter
cambiare la mia password. (A)
11. Come utente voglio poter fare il log out. (N)
12. Come utente, desidero avere un profilo utente in modo da poter impostare un
nickname.(A)
13. Come utente, desidero avere un profilo utente in modo da poter impostare
un'immagine personale. (A)
14. Come utente, voglio avere la possibilità di effettuare segnalazioni. (S)
15. Come utente, voglio avere la possibilità di accedere alla pagina delle recensioni
da parte anche di altri utenti. (A)
16. Come utente, voglio poter recensire il film. (A)
17. Come utente, voglio poter eliminare le mie recensioni. (A)
18. Come utente voglio poter modificare le mie recensioni. (A)
19. Come utente, voglio poter lasciare un commento nella sezione commenti
relativa ad un film. (A)
20. Come utente, voglio poter rispondere ad un commento di un utente. (A)
    
• Amministratore:

1. Come amministratore, desidero avere delle impostazioni di amministrazione in
modo da poter eliminare gli utenti. (S)
2. Come amministratore, desidero avere delle impostazioni di amministrazione in
modo da poter bannare gli utenti. (S)
3. Come amministratore, voglio poter creare nuovi account utente. (S)
4. Come amministratore, voglio poter accedere a tutte le funzionalità
dell’applicazione, compresa la gestione degli utenti e dei contenuti. (S)
5. Come amministratore voglio poter visualizzare le segnalazioni degli utenti
registrati. (S)

Ruoli e Diritti di Accesso:

-Utente non Registrato:

Accesso a: Pagina iniziale con film, visualizzazione trama, trailer e punteggio di TMDB.
Possibilità di: Sign up tramite e-mail o Google.

-Utente Registrato:

Accesso a: Tutto ciò a cui ha accesso l'utente non registrato.
Possibilità di: Sign in dopo aver verificato l'account, gestione dei film preferiti, recensioni, profilo utente e
commenti ai film.

-Amministratore:

Accesso a: Tutto ciò a cui hanno accesso gli utenti registrati, inoltre, accesso alle impostazioni di
amministrazione e ricevuta delle segnalazioni utenti.

Controllo dell'Accesso:
Durante l'accesso al sistema, il sistema verificherà il ruolo dell'utente (utente non
registrato, utente registrato, amministratore) e lo reindirizzerà alla pagina appropriata in base a tale ruolo.
Gli utenti non registrati possono accedere solo alle funzionalità limitate e alle pagine pubbliche. Una volta
essersi registrati alla pagina all'utente verrà inviata una mail con il codice di verifica per completare la
registrazione e autenticare l'account. Gli utenti registrati avranno accesso a funzionalità aggiuntive come la
gestione dei film preferiti, le recensioni e il profilo utente e i commenti dei film. Gli amministratori avranno
accesso completo a tutte le funzionalità, comprese le impostazioni di amministrazione e le segnalazioni
utenti.


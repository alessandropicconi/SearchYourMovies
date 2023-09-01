 
var tab = $('#tabs');
 
//Itera su tutti gli utenti
function fetchUsers(){
   USER_LIST.forEach(user =>addUserToPage(user));
 ;}
//Crea gli elementi della tabella
function addUserToPage(user)
{ 
  //Riga corrente
  var tr=document.createElement("tr");

  //Nome utente
  var tu=document.createElement("td");
  tu.append(user.user);

  //Id utente 
  var ti=document.createElement("td");
  ti.append(user.id);

  //Email utente
  var te=document.createElement("td");
  te.append(user.email);

  //Checkbox per bannare
  var td=document.createElement("td"); 
  var ban=document.createElement("input");
  ban.setAttribute("type","checkbox");
  ban.setAttribute("id","banUser"+user.id);
  ban.setAttribute("class","banUser"+user.user);
  if(user.is_admin=='1')                     //l'admin non può essere bannato 
     ban.setAttribute("disabled","true");
  if(user.status=="0")
  ban.checked=true;
  ban.setAttribute("onclick","banUser("+user.id+")"); 
  td.append(ban);

  //Pulsante per eliminare l'utente
 remove_user = `
  <form method="post" action="/web/action/do-remove-from-users.php">
  <input type="hidden" name="movieTitle" value="${user.id}" />  
  <button class="btn btn-success w3-red" type="submit" name="id" value="${user.id}"> elimina </button>
  </form>
  `
  var tb=document.createElement("td");
  var b=document.createElement("button");
  b.setAttribute("type","button");
  b.setAttribute("class","btn btn-success w3-red"); 
  b.setAttribute("onclick","removeUser("+user.id+","+user.is_admin+")");
  b.append("elimina");
  $(tb).append(remove_user);

  //Pulsante per visualizzare il profilo
  var tp=document.createElement("td");
  var profile=document.createElement("button");
  profile.onclick=function(){
    $id=user.id;
    $user_name=user.user;
      location.href="/web/pages/user-profile.php?id="+$id+"&user_name="+$user_name   
};
  profile.setAttribute("class","w3-green");
  profile.append("visualizza");
  tp.append(profile);
  
  //Aggiungi gli elementi alla riga corrente
  tr.append(tu);
  tr.append(ti);
  tr.append(te);
  tr.append(tp);
  tr.append(tb);
  tr.append(td);
  

  tab.append(tr);
  };
  
  //Funzione per elimnare l'utente, /web/action/do-remove-from-users.php
  async function removeUser(id,is_admin){
    if(is_admin=='1') window.alert("Cannot remove an admin");  //l'admin non può essere eliminato
      else if (window.confirm('Delete this user from database?')) {
      $.post("/web/action/do-remove-from-users.php",{
        id
      }).then(() => {
        location.reload();
      })
    }
  };
//Funzione per bannare l'utente
async function banUser(id){

    if(document.getElementById('banUser'+id).checked==true)
    $.post("/web/action/do-ban.php",{
      id
     });
    else
    $.post("/web/action/do-unban.php",{
      id 
    });
};

//Prendi gli utenti alla visualizzazione della pagina
fetchUsers(); 

   
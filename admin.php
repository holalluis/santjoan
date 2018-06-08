<?php
  $admin=false;

  if(isset($_COOKIE['admin']) && $_COOKIE['admin']=='bumbumtamtam'){
    $admin=true;

    ?>
      <script>
        //funcions admin
        var Admin={
          update:function(taula,id,camp,nouValor){
            console.log('update',taula,id,camp,nouValor);
            var xhr=new XMLHttpRequest();
            xhr.open('POST',"update.php",true);
            xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xhr.onreadystatechange=function(){
              if(this.readyState==4&&this.status==200){
                console.log(this.responseText);
                window.location.reload();
              }
            }
            xhr.send("taula="+taula+"&id="+id+"&camp="+camp+"&nouValor="+nouValor);
          },

          delete:function(taula,id){
            console.log('delete',taula,id);
            var xhr=new XMLHttpRequest();
            xhr.open('POST',"delete.php",true);
            xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xhr.onreadystatechange=function(){
              if(this.readyState==4&&this.status==200){
                console.log(this.responseText);
                window.location.reload();
              }
            }
            xhr.send("taula="+taula+"&id="+id);
          },
        };
      </script>
    <?php
  }
?>

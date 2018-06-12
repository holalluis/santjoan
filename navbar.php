<h2 id=navbar>
  <!--esquerra-->
  <div>
    <span>
      🔥 🔥
    </span>
    <span onclick=window.location='index.php'>
      Sant Joan Boreal 2018
    </span>
    <span>
      <span onclick="window.location='login.php'"> 🔥 </span> 🔥
    </span>
  </div>
  <!--dreta-->
  <?php
    if($admin){ ?>
      <div>
        <button onclick=window.location='logout.php'>
          Sortir admin
        </button>
      </div>
    <?php
    }
  ?>
</h2>

<style>
  #navbar {
    display:flex;
    flex-wrap:wrap;
    justify-content:space-between;
    border-bottom:1px solid #ccc;
  }
</style>

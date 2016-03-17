      <nav class="grey">
        <a href="#" data-activates="slide-out" class="button-collapse">
          <i class="medium material-icons">search</i>
        </a>
        <div class="nav-wrapper" style="background-color:#2bbbad">
          <ul class="right">
            <?php 
            if (!isset($_SESSION['id'])){
              echo '<li><a href="/src/?page=search" class="waves-effect waves-block waves-light chat-collapse">Search</a></li>';
              echo '<li><a href="/src/?page=login" data-activates="chat-out" class="waves-effect waves-block waves-light chat-collapse">Sign In</a></li>';
            }
            else {
              echo '<li style="padding: 0px 5px">'.strtoupper($_SESSION['firstName']. ' '. $_SESSION['lastName']).'</li>';
              echo '<li><a href="/src/?page=search" class="waves-effect waves-block waves-light chat-collapse">Search</a></li>';
              if ($_SESSION['id'] == 0) 
                echo '<li><a href="/src/?page=stats" class="waves-effect waves-block waves-light chat-collapse">Stats</a></li>';
              echo '<li><a href="/src/?page=historic" class="waves-effect waves-block waves-light chat-collapse">History</a></li>';
              echo '<li><a href="/src/?page=logout" class="waves-effect waves-block waves-light chat-collapse">Sign Out</a></li>';
            }
            ?>
          </ul>
        </div>
      </nav>
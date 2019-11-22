@if (Auth::check() && Auth::user()->is_admin)
<div class="wrapper">

    <!-- Sidebar -->
    <nav id="sidebar">
    <div class="sidebar-header">
            <h3 class="title-sidebar">BitChest</h3>
        </div>
       
        <ul class="list-unstyled components">
           
                <p class="user-status">Administrateur</p>
           
               
              
              
              
              <a class="nav-link" style="color: #003366;" href="/homeAdmin">Home Admin</a>
              
        
   
                
           
            </li>
            <li>
                <a class="nav-link" style="color: #003366;" href="/profile">My profile Admin</a>
            </li>
            <li>
            
                <a class="nav-link" style="color: #003366;" href="/userManage">User Manage</a>
           
            </li>
            <li>
            <a class="nav-link" style="color: #003366;" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Déconnexion
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
            </li>
        </ul>
    </nav>
</div> 
@else
<div class="wrapper">

    <!-- Sidebar -->
    <nav id="sidebar">
    <div class="sidebar-header">
            <h3 class="title-sidebar">BitChest</h3>
        </div>

        <ul class="list-unstyled components">
            
                <p class="user-status">Client</p>
            
            <li class="active">
            
          
              
              
              
             
              <a class="nav-link" style="color: #003366;" href="/homeClient">Home Client</a>
             
        

   
            </li>
            <li>
                <a class="nav-link" style="color: #003366;" href="/profile">My profile Customer</a>
            </li>
            <li>
          
                <a class="nav-link" style="color: #003366;" href="/wallet">My wallet</a>
         
            </li>
            <li>
            <a class="nav-link" style="color: #003366;" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Déconnexion
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
            </li>
        </ul>
    </nav>
</div> 
@endif
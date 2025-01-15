
<link rel="stylesheet" href="assets/css/styles.css">

<style>
/* Show dropdown menu on hover */
.nav-item.dropdown:hover .dropdown-menu {
  display: block;
  margin-top: 0; /* Removes the gap between nav-item and dropdown */
}

/* Style for hovered or active dropdown item */
.dropdown-menu .dropdown-item:hover,
.dropdown-menu .dropdown-item.active {
  background-color: #eb0905; /* Red background for hover or active state */
  color: #fff; /* Ensure text is visible */
}


</style>
<!-- Top Navbar -->
<!-- Top Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-black" style="padding: 0.5rem 1rem;">
  <div class="container-fluid">
    <!-- Logo -->
    <a class="navbar-brand" href="{{route('home')}}">
      <img src="assets/logo/logo.png" alt="Logo" width="150" style="max-height: 50px;">
    </a>

    <!-- Search Bar -->
    <form class="d-none d-lg-flex mx-auto" style="width: 40%;">
      <select name="category" class="form-select me-2" style="width: 25%;">
        <option value="all">All</option>
      </select>
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-light" type="submit">Search</button>
    </form>

    <!-- User and Cart Icons -->
    <div class="d-flex">
      <a href="#" class="btn btn-link text-light me-3" style="font-size: 1.25rem;">
        <i class="fa fa-user"></i>
      </a>
      <div class="cart-container" style="position: relative; display: inline-block;">
  <span class="cart-label" id="cart-count" style="position: absolute; top: -10px; right: -10px; background-color: #eb0905; color: white; border-radius: 50%; padding: 2px 6px; font-size: 0.8rem; display: none;">
    0
  </span>
  <a href="{{route('frontend.cart')}}" class="btn btn-link text-light" style="font-size: 1.25rem;">
    <i class="fa fa-shopping-cart"></i>
  </a>
</div>



    </div>

    <!-- Toggler for mobile view -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>


<!-- Secondary Navbar -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="nextDayDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Next Day</a>
          <ul class="dropdown-menu" aria-labelledby="nextDayDropdown">
          <li><a class="dropdown-item" href="{{route('NextDayDeliveryGamingPCs')}}">Next Day Gaming PCs</a></li>
          <li><a class="dropdown-item" href="{{route('GamingPcs')}}">Gaming PC</a></li>
          <li><a class="dropdown-item" href="{{route('NextDayDeliveryDesktopPCs')}}">Next Day Desktop</a></li>
          <li><a class="dropdown-item" href="{{route('NextDayLaptop')}}">Next Day Laptop</a></li>
          <li><a class="dropdown-item" href="{{route('NextDayComponents')}}">Next Day Components</a></li>
          <li><a class="dropdown-item" href="{{route('NextDayStorage')}}">Next Day Storage</a></li>
          <li><a class="dropdown-item" href="{{route('NextDayPeripherals')}}">Next Day Peripheral</a></li>
          <li><a class="dropdown-item" href="{{route('NextDayNetworking')}}">Next Day Networking</a></li>
          </ul>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="{{route('custompcs')}}" id="customPCDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Custom PCs</a>
          <ul class="dropdown-menu" aria-labelledby="customPCDropdown">
          <li><a class="dropdown-item" href="{{route('BuildyourownPCs')}}">Build Your Own PC</a></li>
          <li><a class="dropdown-item" href="{{route('GamingPcs')}}">Gaming PC</a></li>
          <li><a class="dropdown-item" href="{{route('WorkstationPCs')}}">Workstation PCs</a></li>
          <li><a class="dropdown-item" href="{{route('HomeOfficePCs')}}">Home/Office PCs</a></li>
          <li><a class="dropdown-item" href="{{route('PCsByBudget')}}">PCs by Budget</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="desktopPCDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Laptops PCs</a>
          <ul class="dropdown-menu" aria-labelledby="desktopPCDropdown">
          <li><a class="dropdown-item" href="{{route('Applelaptops')}}">Apple Laptops</a></li>
          <li><a class="dropdown-item" href="{{route('GamingLaptops')}}">Gaming Laptops</a></li>
          <li><a class="dropdown-item" href="{{route('HomeAndOfficeLaptops')}}">Home/Office Laptops</a></li>
          <li><a class="dropdown-item" href="{{route('LaptopBagsandsleeves')}}">Laptop Bags and Sleeves</a></li>
          <li><a class="dropdown-item" href="{{route('Laptopdocks')}}">Laptop Docks</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="desktopPCDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Components</a></a>
          <ul class="dropdown-menu" aria-labelledby="desktopPCDropdown">
          <li><a class="dropdown-item" href="{{route('Cases')}}">Cases</a></li>
          <li><a class="dropdown-item" href="{{route('motherboards')}}">Motherboards</a></li>
          <li><a class="dropdown-item" href="{{route('CPUproccessors')}}">CPU Processor</a></li>
          <li><a class="dropdown-item" href="{{route('Memory')}}">Memory</a></li>
          <li><a class="dropdown-item" href="{{route('Storage')}}">Storage</a></li>
          <li><a class="dropdown-item" href="{{route('GraphicsCards')}}">Graphics Cards</a></li>
          <li><a class="dropdown-item" href="{{route('PowerSupplies')}}">Power Supplies</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="desktopPCDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Peripherals</a>
          <ul class="dropdown-menu" aria-labelledby="desktopPCDropdown">
          <li><a class="dropdown-item" href="{{route('MouseAndKeyboard')}}">Mouse & Keyboards</a></li>
          <li><a class="dropdown-item" href="{{route('HeadsetsMicrophonesandWebcams')}}">Headsets microphones and webcams</a></li>
          <li><a class="dropdown-item" href="{{route('Printing')}}">Printing</a></li>
          <li><a class="dropdown-item" href="{{route('gamingaccessories')}}">Gaming Accessories</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="desktopPCDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Software</a>
          <ul class="dropdown-menu" aria-labelledby="desktopPCDropdown">
          <li><a class="dropdown-item" href="{{route('MicrosoftLincenses')}}">Microsoft Licences</a></li>
          <li><a class="dropdown-item" href="{{route('AntivirusSoftware')}}">Antivirus Software</a></li>
          <li><a class="dropdown-item" href="{{route('ITSupportPackages')}}">IT Support Packages</a></li>
          </ul>
        </li>


        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="desktopPCDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Networking</a>
          <ul class="dropdown-menu" aria-labelledby="desktopPCDropdown">
          <li><a class="dropdown-item" href="{{route('Businessnetworking')}}">Business Networking</a></li>
          <li><a class="dropdown-item" href="{{route('Ubiquiti')}}">Ubiquiti</a>
          <li><a class="dropdown-item"href="{{route('RoutersAndMeshSystemsAndSwitches')}}">Routers/Mesh Systems & Switches</a></li>
          <li><a class="dropdown-item"href="{{route('NetworkModules')}}">Network Modules</a>
          <li><a class="dropdown-item" href="{{route('ServersAndRackCabinets')}}">Servers & Rack Cabinets</a></li>
          <li><a class="dropdown-item" href="{{route('PCIPCIEAddinCards')}}">PCI/PCI-E Add in Cards</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="desktopPCDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Brands</a>
          <ul class="dropdown-menu" aria-labelledby="desktopPCDropdown">
          <li><a class="dropdown-item" href="{{route('asus')}}">ASUS</a></li>
          <li><a class="dropdown-item" href="{{route('Apple')}}">Apple</a></li>
          <li><a class="dropdown-item" href="{{route('amd')}}">AMD</a></li>
          <li><a class="dropdown-item"href="{{route('BEQUIET')}}">be quiet!</a></li>
          <li><a class="dropdown-item"href="{{route('Canon')}}">Canon</a></li>
          <li><a class="dropdown-item" href="{{route('Corsair')}}">Corsair</a></li>
          <li><a class="dropdown-item" href="{{route('DeepCool')}}">DeepCool</a></li>
          <hr style="color:#eb0905; font-weight:600; font-size:35px">
          <li><a class="dropdown-item"href="{{route('Kingston')}}">Kingston</a></li>
          <li><a class="dropdown-item"href="{{route('HP')}}">HP</a></li>
          <li><a class="dropdown-item"href="{{route('HPE')}}">HPE</a></li>
          <li><a class="dropdown-item"href="{{route('Marvo')}}">Marvo</a></li>
          <li><a class="dropdown-item" href="{{route('piXL')}}">piXL</a></li>
          <li><a class="dropdown-item"href="{{route('Samsung')}}">Samsung</a></li>
          <li><a class="dropdown-item"href="{{route('TPLink')}}">TP-Link</a></li>
          <li><a class="dropdown-item"href="{{route('GamingPcs')}}">Western Digital</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="desktopPCDropdown" style="background-color: rgb(0, 0, 255); color:#ffffff"  role="button" data-bs-toggle="dropdown" aria-expanded="false">Local IT Services</a>
          <ul class="dropdown-menu" aria-labelledby="desktopPCDropdown">
          <li><a class="dropdown-item" href="{{route('ComputerRepairsAndTroubleshooting')}}">Computer Repairs & Troubleshooting</a></li>
          <li><a class="dropdown-item" href="{{route('ComputerUpgradesAndOptimisation')}}">Computer Upgrades and Optimisation</a></li>
          <li><a class="dropdown-item" href="{{route('ComputerSetupAndDataTransfer')}}">Computer Setup & Data Transfer</a></li>
          <li><a class="dropdown-item" href="{{route('VirusAndMalwareRemoval')}}">Virus & Malware Removal</a></li>
          <li><a class="dropdown-item" href="{{route('backupsolution')}}">Backup Solutions</a></li>
          <li><a class="dropdown-item" href="{{route('DataRecovery')}}">Data Recovery</a></li>
          <li><a class="dropdown-item" href="{{route('DataDestruction')}}">Data Destruction</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" style="background-color: rgb(255, 0, 13); color:white;"  href="#" id="desktopPCDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Business & Public Sector IT</a>
          <ul class="dropdown-menu" aria-labelledby="desktopPCDropdown">
          <li><a class="dropdown-item" href="{{route('ITProcurementServices')}}">IT Procurement Services</a></li>
        <li><a class="dropdown-item" href="{{route('ManagedITSupportServices')}}">Managed IT Support Services</a></li>
        <li><a class="dropdown-item" href="{{route('cloudsolutions')}}">Cloud Solutions</a></li>
        <li><a class="dropdown-item" href="{{route('Microsoft365Services')}}">Microsoft 365 Services</a></li>
        <li><a class="dropdown-item" href="{{route('CyberSecurityService')}}">Cyber Security Services</a></li>
        <li><a class="dropdown-item" href="{{route('DataServices')}}">Data Services</a></li>
        <li><a class="dropdown-item" href="{{route('SystemAppDevSupport')}}">System App & Dev Support</a></li>
        <li><a class="dropdown-item" href="#">Business IT Products</a></li>
        <li><a class="dropdown-item" href="{{route('ITProcurementServices')}}">IT Procurement Services</a></li>
        <li><a class="dropdown-item" href="{{route('ITEquipmentLeasingAndFinance')}}">IT Equipment Leasing & Finance</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

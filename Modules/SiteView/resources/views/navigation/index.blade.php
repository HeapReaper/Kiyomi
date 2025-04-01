@extends('panel::layouts.master')

@section('title', 'Menu aanpassen')

@section('content')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <div class="container mt-5 p-2 bg-dark rounded bg-opacity-25 shadow-lg">
    <h1 class="text-white ">Voorbeeld nav:</h1>

    <!-- EXAMPLE NAV -->
    <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-opacity-50 mt-4" style="background-color: #d80414;">
      <div class="container-fluid">
        <a class="navbar-brand text-white" href="/">
          <img src="/app_media/faticon.ico" width="30" height="30" class="d-inline-block align-top ms-2" alt="">
          TRMC
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav" id="sortableNav">
          </ul>
        </div>
      </div>
    </nav>
  </div>


  <!-- OPTIONS TO ADD -->
  <div class="container mt-4">
    <div class="row">
      <!-- LINKS -->
      <div class="col me-1 p-2 bg-dark rounded bg-opacity-25 shadow-lg">
        <h5 class="text-white">Links</h5>

        <div class="mb-3">
          <label for="link_name" class="form-label text-white">Naam</label>
          <input type="text" class="form-control" id="link_name" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
          <select class="form-select" aria-label="Link type" id="link_type" onchange="changeLinkType()">
            <option selected>Selecteer een link type</option>
            <option value="url">URL</option>
            <option value="article">Artikel</option>
          </select>
        </div>

        <div class="mb-3" style="display: none;" id="url_field">
            <label for="url_link" class="form-label text-white">Link</label>
            <input type="text" class="form-control" id="url_link" aria-describedby="url_name">
        </div>

        <div class="mb-3" style="display: none;" id="article_field">
          <label for="articles" class="text-white">Zoek je artikel</label>
          <input list="articles" id="articleList" class="form-control" placeholder="Typ om je artikel te vinden">
          <datalist id="articles">
            @foreach($articles as $article)
              <option value="{{  $article->slug }}">{{ $article->title }}</option>
            @endforeach
          </datalist>
        </div>

        <button id="addLink" class="btn text-white" style="background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%)">Toevoegen</button>
      </div>

      <!-- DROPDOWNS -->
      <div class="col ms-1 p-2 bg-dark rounded bg-opacity-25 shadow-lg">
        <h5 class="text-white">Dropdowns</h5>

        <div class="mb-3">
          <label for="dropdown_name" class="form-label text-white">Naam</label>
          <input type="text" class="form-control" id="dropdown_name" aria-describedby="dropdown_name">
        </div>

        <button id="addDropdown" class="btn text-white" style="background-image: linear-gradient(45deg, #874da2 0%, #c43a30 100%)">Toevoegen</button>

      </div>
    </div>
  </div>

  <script>
    // Sortable
    document.addEventListener('DOMContentLoaded', function () {
      new Sortable(document.getElementById('sortableNav'), {
        animation: 150,
        ghostClass: 'sortable-ghost',
        direction: 'horizontal',

      });
    });

    // New link
    document.addEventListener('DOMContentLoaded', function() {
      const addLinkButton = document.getElementById('addLink');
      const sortableNav = document.getElementById('sortableNav');

      addLinkButton.addEventListener('click', function () {
        console.log('Adding a new link');

        const newNavItem = document.createElement('li');
        newNavItem.classList.add('nav-item');
        newNavItem.setAttribute('data-id', Date.now());

        const newNavLink = document.createElement('a');
        newNavLink.classList.add('nav-link', 'text-white');
        if (document.getElementById('link_type').value == 'url') {
          newNavLink.href = document.getElementById('url_link').value;
        } else {
          newNavLink.href = document.getElementById('articleList').value;
        }

        newNavLink.textContent = document.getElementById('link_name').value;
        newNavItem.appendChild(newNavLink);
        sortableNav.appendChild(newNavItem);
      });
    });

    // Add dropdown
    document.addEventListener('DOMContentLoaded', function () {
      // Existing sortable nav
      new Sortable(document.getElementById('sortableNav'), {
        animation: 150,
        ghostClass: 'sortable-ghost',
        direction: 'horizontal',
      });

      // Add link functionality
      const addDropdownButton = document.getElementById('addDropdown');
      const sortableNav = document.getElementById('sortableNav');

      addDropdownButton.addEventListener('click', function () {
        const newNavItem = document.createElement('li');
        newNavItem.classList.add('nav-item');
        newNavItem.setAttribute('data-id', Date.now());

        const newNavLink = document.createElement('a');
        newNavLink.classList.add('nav-link', 'text-white');
        if (document.getElementById('link_type').value == 'url') {
          newNavLink.href = document.getElementById('url_link').value;
        } else {
          newNavLink.href = document.getElementById('articleList').value;
        }

        newNavLink.textContent = document.getElementById('link_name').value;
        newNavItem.appendChild(newNavLink);
        sortableNav.appendChild(newNavItem);
      });

      // Add dropdown functionality
      const addDropdownButton = document.getElementById('addDropdown');

      addDropdownButton.addEventListener('click', function () {
        const dropdownName = document.getElementById('dropdown_name').value || 'New Dropdown';

        // Create <li> element with dropdown class
        const newDropdown = document.createElement('li');
        newDropdown.classList.add('nav-item', 'dropdown');

        // Create <a> element (Dropdown Toggle)
        const dropdownToggle = document.createElement('a');
        dropdownToggle.classList.add('nav-link', 'dropdown-toggle', 'text-white', 'd-flex', 'align-items-center');
        dropdownToggle.href = "#";
        dropdownToggle.setAttribute('role', 'button');
        dropdownToggle.setAttribute('data-bs-toggle', 'dropdown');
        dropdownToggle.setAttribute('aria-expanded', 'false');
        dropdownToggle.innerHTML = dropdownName;

        // Create <ul> dropdown menu (Sortable)
        const dropdownMenu = document.createElement('ul');
        dropdownMenu.classList.add('dropdown-menu', 'bg-dark', 'sortable-dropdown'); // Add class for sorting

        const dropdownItem1 = document.createElement('a');
        dropdownItem1.classList.add('dropdown-item', 'text-white');
        dropdownItem1.href = '#';
        dropdownItem1.textContent = 'Test Item';

        const dropdownItem2 = document.createElement('a');
        dropdownItem2.classList.add('dropdown-item', 'text-white');
        dropdownItem2.href = '#';
        dropdownItem2.textContent = 'Test Item 2';

        dropdownMenu.appendChild(dropdownItem1);
        dropdownMenu.appendChild(dropdownItem2);

        // Append elements
        newDropdown.appendChild(dropdownToggle);
        newDropdown.appendChild(dropdownMenu);
        sortableNav.appendChild(newDropdown);

        // Make the new dropdown menu sortable
        new Sortable(dropdownMenu, {
          animation: 150,
          ghostClass: 'sortable-ghost',
          fallbackOnBody: true,
          swapThreshold: 0.65
        });
      });

      // Enable sorting for existing dropdowns
      document.querySelectorAll('.dropdown-menu').forEach(dropdown => {
        new Sortable(dropdown, {
          animation: 150,
          ghostClass: 'sortable-ghost',
          fallbackOnBody: true,
          swapThreshold: 0.65
        });
      });
    });


    // Enable sorting for existing dropdowns
    document.querySelectorAll('.dropdown-menu').forEach(dropdown => {
      new Sortable(dropdown, {
        animation: 150,
        ghostClass: 'sortable-ghost',
        fallbackOnBody: true,
        swapThreshold: 0.65
      });
    });

    function changeLinkType() {
      let linkType = document.getElementById("link_type").value;
      let urlField = document.getElementById("url_field");
      let articleField = document.getElementById("article_field");

      if (linkType === "url") {
        urlField.style.display = "block";
        articleField.style.display = "none";
      } else if (linkType === "article") {
        urlField.style.display = "none";
        articleField.style.display = "block";
      } else {
        urlField.style.display = "none";
        articleField.style.display = "none";
      }
    }
  </script>


  <style>
    .sortable-ghost {
      opacity: 0.5;
    }
    .inline-dropdown {
      display: inline-flex;
      align-items: center;
    }

    .inline-menu {
      list-style: none;
      padding: 0;
      margin: 0;
      display: flex;
    }

    .inline-menu li {
      margin-right: 10px;
    }

    .form-select {
      background-color: rgba(255, 255, 255, 0.1) !important;
      border: 1px solid rgba(255, 255, 255, 0.2) !important;
      border-radius: 5px !important;
      padding: 10px !important;
      color: white !important;
      font-size: 14px !important;
    }

    .form-select::placeholder {
      color: white !important;
    }

    .form-select:focus {
      color: white !important;
    }

    .form-select option {
      color: #000000;
      padding: 8px 16px;
      border: 1px solid transparent;
      border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
      cursor: pointer;
    }
  </style>
@stop

@extends('panel::layouts.master')

@section('title', 'Menu aanpassen')

@section('content')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>

  <div id="container-1" class="nested-sortable">
    <div class="nested-sortable-item">One</div>
  </div>

  <button id="addItemButton">Voeg link toe</button>

  <script>
    var nestedSortables = document.querySelectorAll('.nested-sortable');

    for (var i = 0; i < nestedSortables.length; i++) {
      new Sortable(nestedSortables[i], {
        group: 'nested',
        animation: 150,
        fallbackOnBody: true,
        swapThreshold: 0.65,
        ghostClass: 'sortable-ghost',
        chosenClass: 'sortable-chosen',
        onEnd: function(evt) {
          if (evt.to !== evt.from) {
            makeContainer(evt.item);
          }
        }
      });
    }

    // Function to make an item a container if it isn't already
    function makeContainer(item) {
      if (!item.classList.contains('nested-sortable')) {
        item.classList.add('nested-sortable');
        new Sortable(item, {
          group: 'nested',
          animation: 150,
          fallbackOnBody: true,
          swapThreshold: 0.65,
          ghostClass: 'sortable-ghost',
          chosenClass: 'sortable-chosen'
        });
      }
    }

    // Function to add a new item to a container
    function addItemToContainer(newItemHtml, containerSelector) {
      var container = document.querySelector(containerSelector);
      if (container) {
        var newItem = document.createElement('div');
        newItem.className = 'nested-sortable-item';
        newItem.innerHTML = newItemHtml;
        container.appendChild(newItem);
        makeContainer(newItem);
      }
    }

    // Event listener for the "Add Item" button
    document.getElementById('addItemButton').addEventListener('click', function() {
      addItemToContainer('New Item', '#container-1');
    });

    // Make existing items containers
    var items = document.querySelectorAll('.nested-sortable-item');
    items.forEach(function(item) {
      makeContainer(item);
    });
  </script>

  <style>
    .nested-sortable {
      border: 1px solid #ccc;
      padding: 10px;
      margin-bottom: 20px;
    }

    .nested-sortable-item {
      border: 1px solid #999;
      padding: 10px;
      margin-bottom: 40px;
      background-color: #f9f9f9;
      cursor: move;
    }

    .sortable-ghost {
      opacity: 0.4;
      background-color: #ccc;
    }

    .sortable-chosen {
      background-color: #e0e0e0;
    }
  </style>
@stop

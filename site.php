
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Форма для збору даних про якість повітря</title>
  <style>
    
    #map {
      height: 400px; /* Змініть висоту, якщо потрібно */
      border: 2px solid #ccc;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }

    table { 
      border-collapse: collapse;
      width: 100%;
      margin-bottom: 20px;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

    .edit-table-container {
      display: none;
    }

    .edit-table-container.show {
      display: block;
    }

    .edited-row {
      background-color: lightblue;
    }
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      color: #333;
    }

    h1 {
      text-align: center;
      color: #007bff;
    }

    #map {
      height: 400px;
      border: 2px solid #ccc;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }
    table {
      border-collapse: collapse;
      width: 100%;
      margin-bottom: 20px;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

    .edit-table-container {
      display: none;
      margin-bottom: 20px;
      padding: 10px;
      background-color: #f9f9f9;
      border-radius: 5px;
    }
    .edited-row {
      background-color: lightblue;
    }
    input[type="button"], button {
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    input[type="button"]:hover, button:hover {
      background-color: #0056b3;
    }



  </style>
  <!-- Підключення Leaflet (бібліотеки для відображення карт) -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
</head>
<body>

  <h1>Форма для збору даних про якість повітря</h1>

  <!-- Додано карту з ID "map" для застосування CSS стилів -->
  <div id="map"></div>

  <!-- Додано таблицю для відображення збереженої інформації -->
  <h2>Збережена інформація</h2>
  <table id="dataTable">
    <tr>
      <th>Місто</th>
      <th>Забруднювач</th>
      <th>Рівень забруднення</th>
      <th>Дії</th>
    </tr>
  </table>

  <!-- Окрема таблиця для редагування -->
  <div class="edit-table-container" id="editTableContainer">
    <h2>Редагування інформації</h2>
    <table id="editTable">
      <tr>
        <th>Місто</th>
        <th>Забруднювач</th>
        <th>Рівень забруднення</th>
        <th>Підтвердити</th>
      </tr>
    </table>
  </div>
  

  <form id="airQualityForm" action="air_quality.php" method="post">
  <form id="airQualityForm">
    <label for="citySelect">Місто:</label>
    <select id="citySelect" name="city" onchange="updateCoordinates()">
      <option value="Київ">Київ</option>
      <option value="Харків">Харків</option>
      <option value="Одеса">Одеса</option>
      <option value="Дніпро">Дніпро</option>
      <option value="Донецьк">Донецьк</option>
      <option value="Запоріжжя">Запоріжжя</option>
      <option value="Львів">Львів</option>
      <option value="Кривий Ріг">Кривий Ріг</option>
      <option value="Миколаїв">Миколаїв</option>
      <option value="Полтава">Полтава</option>
      <option value="Рівне">Рівне</option>
      <option value="Суми">Суми</option>
      <option value="Тернопіль">Тернопіль</option>
      <option value="Ужгород">Ужгород</option>
      <option value="Херсон">Херсон</option>
      <option value="Хмельницький">Хмельницький</option>
      <option value="Черкаси">Черкаси</option>
      <option value="Чернівці">Чернівці</option>
      <option value="Чернігів">Чернігів</option>
      <option value="Мукачево">Мукачево</option>
      <option value="Житомир">Житомир</option>
      <option value="Івано-Франківськ">Івано-Франківськ</option>
      <option value="Ізмаїл">Ізмаїл</option>
      <option value="Стрий">Стрий</option>
<option value="Хуст">Хуст</option>
<option value="Червоноград">Червоноград</option>
<option value="Щастя">Щастя</option>
      </select><br><br>

      

    <label for="pollutant">Забруднювач:</label>
    <input type="text" id="pollutant" name="pollutant"><br><br>

    <label for="level">Рівень забруднення:</label>
    <select id="level" name="level">
      <option value="Низький">Низький</option>
      <option value="Середній">Середній</option>
      <option value="Високий">Високий</option>
      <!-- Додайте інші рівні забруднення за потребою -->
    </select><br><br>

    <input type="button" value="Submit" onclick="sendData()">
  </form>
  <h2>Пояснення рівнів забруднення</h2>
  <table style="border: 2px solid rgb(99, 21, 245); border-collapse: collapse;">
  <tr>
    <th>Рівень</th>
    <th>Пояснення</th>
    <th>Колір</th>
  </tr>
  <tr>
    <td>Низький</td>
    <td>Незначний вплив на здоров'я</td>
    <td style="background-color: green;"></td>
  </tr>
  <tr>
    <td>Середній</td>
    <td>Шкідливий для чутливих груп людей</td>
    <td style="background-color: yellow;"></td>
  </tr>
  <tr>
    <td>Високий</td>
    <td>Шкідливий для всіх</td>
    <td style="background-color: orange;"></td>
  </tr>
</table>
<h2>Топ-10 найбрудніших міст</h2>
<table id="topCitiesTable">
  <tr>
    <th>Місто</th>
    <th>Рівень забруднення</th>
  </tr>
</table>
  </table>
  <script>
    function getColorForLevel(level) {
      switch (level) {
        case 'Низький':
          return 'green';
        case 'Середній':
          return 'yellow';
        case 'Високий':
          return 'orange';
        default:
          return 'inherit';
      }
    }
    var map = L.map('map').setView([49.0275, 31.4828], 6);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
      maxZoom: 18
    }).addTo(map);

    var markers = {};

    var bounds = [[44.1846, 22.0850], [52.3791, 40.2276]];
    map.setMaxBounds(bounds);
    map.on('drag', function () {
      map.panInsideBounds(bounds, { animate: false });
    });

    var coordinates = [0, 0];

    function updateCoordinates() {
      const city = document.getElementById('citySelect').value;

      switch (city) {
        case 'Київ':
          coordinates = [50.4501, 30.5234];
          break;
        case 'Харків':
          coordinates = [49.9935, 36.2304];
          break;
        // Додайте координати для інших міст за потребою
        default:
          coordinates = [0, 0];
      }
    }

    function sendData() {
  const city = document.getElementById('citySelect').value;
  const pollutant = document.getElementById('pollutant').value;
  const level = document.getElementById('level').value;
  const xhr = new XMLHttpRequest();
  const url = 'air_quality.php'; // URL, на який буде відправлено дані
  xhr.open('POST', url, true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        // Вивід повідомлення про успішну вставку даних у базу даних
        console.log(xhr.responseText);
      } else {
        // Вивід повідомлення про помилку, якщо запит не вдалося виконати
        console.error('Request failed:', xhr.status);
      }
    }
  };
  const data = `city=${encodeURIComponent(city)}&pollutant=${encodeURIComponent(pollutant)}&level=${encodeURIComponent(level)}`;
  
  

      

      const dataTable = document.getElementById('dataTable');
      const newRow = dataTable.insertRow(-1);
      const cell1 = newRow.insertCell(0);
      const cell2 = newRow.insertCell(1);
      const cell3 = newRow.insertCell(2);
      const cell4 = newRow.insertCell(3);

      cell1.innerHTML = city;
      cell2.innerHTML = pollutant;
      cell3.innerHTML = level;
      cell3.innerHTML = `<span style="color: ${getColorForLevel(level)}">${level}</span>`;

      const editButton = document.createElement('button');
      editButton.innerHTML = 'Edit';
      editButton.onclick = function() {
        editRow(newRow);
      };
      cell4.appendChild(editButton);

      const deleteButton = document.createElement('button');
      deleteButton.innerHTML = 'Delete';
      deleteButton.onclick = function() {
        deleteRow(newRow);
      };
      cell4.appendChild(deleteButton);

      let newMarker;
      switch (city) {
  case 'Київ':
    coordinates = [50.4501, 30.5234];
    break;
  case 'Харків':
    coordinates = [49.9935, 36.2304];
    break;
  case 'Одеса':
    coordinates = [46.4861, 30.7214];
    break;
  case 'Дніпро':
    coordinates = [48.4438, 35.0386];
    break;
  case 'Донецьк':
    coordinates = [48.0159, 37.8029];
    break;
  case 'Запоріжжя':
    coordinates = [47.8388, 35.1396];
    break;
  case 'Львів':
    coordinates = [49.8397, 24.0297];
    break;
  case 'Кривий Ріг':
    coordinates = [47.9104, 33.3913];
    break;
  case 'Миколаїв':
    coordinates = [46.9750, 31.9946];
    break;
  case 'Полтава':
    coordinates = [49.5883, 34.5514];
    break;
  case 'Рівне':
    coordinates = [50.6199, 26.2516];
    break;
  case 'Суми':
    coordinates = [50.9077, 34.7981];
    break;
  case 'Тернопіль':
    coordinates = [49.5535, 25.5948];
    break;
  case 'Ужгород':
    coordinates = [48.6208, 22.2879];
    break;
  case 'Херсон':
    coordinates = [46.6354, 32.6169];
    break;
  case 'Хмельницький':
    coordinates = [49.4229, 26.9873];
    break;
  case 'Черкаси':
    coordinates = [49.4444, 32.0597];
    break;
  case 'Чернівці':
    coordinates = [48.2921, 25.9354];
    break;
  case 'Чернігів':
    coordinates = [51.4982, 31.2893];
    break;
  case 'Житомир':
    coordinates = [50.2547, 28.6587];
    break;
  case 'Івано-Франківськ':
    coordinates = [48.9226, 24.7111];
    break;
  case 'Мукачево':
    coordinates = [48.4438, 22.7184];
    break;
    case 'Ізмаїл':
    coordinates = [45.3504, 28.8365];
    break;
  case 'Краматорськ':
    coordinates = [48.7392, 37.5844];
    break;
    case 'Стрий':
    coordinates = [49.2594, 23.8494];
    break;
  case 'Хуст':
    coordinates = [48.1733, 23.2976];
    break;
  case 'Хмельницький':
    coordinates = [49.4229, 26.9873];
    break;
  case 'Червоноград':
    coordinates = [50.3875, 24.2336];
    break;
  case 'Щастя':
    coordinates = [48.8667, 38.5333];
    break;
  default:
    coordinates = [0, 0];
}


      newMarker = L.marker(coordinates).addTo(map)
        .bindPopup(`${city}<br>Забруднювач: ${pollutant}<br>Рівень забруднення: ${level}`)
        .openPopup();

      markers[newRow.rowIndex] = newMarker;

      document.getElementById('pollutant').value = '';
      document.getElementById('level').value = 'Низький';
      updateTopCitiesTable(); // Оновити таблицю з топ-10 міст після додавання даних
      xhr.send(data);
}

    
  
    function editRow(row) {
      const cells = row.getElementsByTagName('td');
      const city = cells[0].innerHTML;
      const pollutant = cells[1].innerHTML;
      const level = cells[2].innerHTML;

      const editTable = document.getElementById('editTable');
      editTable.innerHTML = `
        <tr class="edited-row">
          <td><input type="text" value="${city}"></td>
          <td><input type="text" value="${pollutant}"></td>
          <td>
            <select>
              <option value="Низький" ${level === 'Низький' ? 'selected' : ''}>Низький</option>
              <option value="Середній" ${level === 'Середній' ? 'selected' : ''}>Середній</option>
              <option value="Високий" ${level === 'Високий' ? 'selected' : ''}>Високий</option>
            </select>
          </td>
          <td><button onclick="updateEditedRow(${row.rowIndex})">Підтвердити</button></td>
        </tr>
      `;

      document.getElementById('editTableContainer').classList.add('show');
    }

    function updateEditedRow(rowIndex) {
      const editTable = document.getElementById('editTable');
      const editedRow = editTable.getElementsByTagName('tr')[0];
      const editedCells = editedRow.getElementsByTagName('td');

      const editedCity = editedCells[0].querySelector('input').value;
      const editedPollutant = editedCells[1].querySelector('input').value;
      const editedLevel = editedCells[2].querySelector('select').value;

      const dataTable = document.getElementById('dataTable');
      const cells = dataTable.rows[rowIndex].getElementsByTagName('td');
      cells[0].innerHTML = editedCity;
      cells[1].innerHTML = editedPollutant;
      cells[2].innerHTML = `<span style="color: ${getColorForLevel(editedLevel)}">${editedLevel}</span>`;
      cells[3].innerHTML = `<button onclick="editRow(this.parentElement.parentElement)">Edit</button>
                        <button onclick="deleteRow(this.parentElement.parentElement)">Delete</button>`;

  const editedMarker = markers[rowIndex];
  editedMarker.setPopupContent(`${editedCity}<br>Забруднювач: ${editedPollutant}<br>Рівень забруднення: ${editedLevel}`);

  document.getElementById('editTableContainer').classList.remove('show');
  updateTopCitiesTable(); // Оновити таблицю з топ-10 міст після редагування даних

}



function deleteRow(row) {
      const cityToDelete = row.cells[0].innerText;

      const xhr = new XMLHttpRequest();
      const url = 'delete_data.php'; // Укажите URL для удаления данных
      xhr.open('POST', url, true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            // Вывод сообщения об успешном удалении данных
            console.log(xhr.responseText);
          } else {
            // Вывод сообщения об ошибке, если запрос не удалось выполнить
            console.error('Request failed:', xhr.status);
          }
        }
      };

      // Отправка данных для удаления на сервер
      const data = `city=${encodeURIComponent(cityToDelete)}`;
      xhr.send(data);

      const index = row.rowIndex;
      map.removeLayer(markers[index]);
      delete markers[index];
      document.getElementById('dataTable').deleteRow(index);
      updateTopCitiesTable(); // Обновить таблицу с топ-10 городов после удаления данных
    }




  function updateTopCitiesTable() {
    const dataTable = document.getElementById('dataTable');
    const rows = dataTable.getElementsByTagName('tr');
    const citiesData = [];

    for (let i = 1; i < rows.length; i++) {
      const city = rows[i].cells[0].innerText;
      const level = rows[i].cells[2].innerText;
      citiesData.push({ city, level });
    }

    citiesData.sort((a, b) => {
      const levels = { 'Низький': 1, 'Середній': 2, 'Високий': 3 };
      return levels[b.level] - levels[a.level];
    });

    // Оновлення таблиці з топ-10 найбруднішими містами
    const topCitiesTable = document.getElementById('topCitiesTable');
    topCitiesTable.innerHTML = `
      <tr>
        <th>Місто</th>
        <th>Рівень забруднення</th>
      </tr>
    `;

    for (let i = 0; i < Math.min(10, citiesData.length); i++) {
      const city = citiesData[i].city;
      const level = citiesData[i].level;
      const row = `<tr><td>${city}</td><td>${level}</td></tr>`;
      topCitiesTable.innerHTML += row;
    }
  }

  // Виклик функції для оновлення топ-10 найбрудніших міст
  updateTopCitiesTable();
</script>

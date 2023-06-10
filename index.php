<?php
?>
<!DOCTYPE html>
<html>
<head>
  <title>Kalender Sepanjang Masa</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link rel="shortcut icon" href="kalender.png">   
  <style>
    .calendar-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      max-height: 100vh;
      overflow-y: scroll;
    }
    .month-container {
      width: calc(80% - 20px);
      margin: 10px;
      padding: 10px;
      border: 1px solid gray;
      text-align: center;
    }
    .month-title {
      font-size: 20px;
      font-weight: bold;
      margin-bottom: 10px;
    }
    .calendar-table {
      width: 100%;
      border-collapse: collapse;
      margin: 0 auto;
    }
    .calendar-table th {
      padding: 5px;
      text-align: center;
      border: 1px solid gray;
      background-color: #ffe599;
    }
    
    .calendar-table th.sunday {
      color: red;
    }
    
    .calendar-table th.friday {
      color: green;
    }
    
    .calendar-table td {
      padding: 5px;
      text-align: center;
      border: 1px solid gray;
      font-size: 17px;
    }
    
    .calendar-day {
      font-weight: bold;
    }
    
    .red {
      color: red;
      font-weight: bold;  
    }
    
    .green {
      color: green;
      font-weight: bold;
    }
    .center {
      text-align: center;
    }
    input.tahun{
      width: 60px;
      font-size: 15px;
    }    
    </style>
    <style>
        button {
            color: blue;
        }			
        /* saat dihover */
        button:hover {
          color: red;
          transition: color 0.3s ease;
          transform: scale(1.1);
        }				
    </style>
    <style>
        /* Styling untuk dialog box */
        .dialog-box {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #efffbf;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            z-index: 9999;
            display: none;
        }
        .dialog-box h3 {
            margin-top: 0;
        }
    </style>
    <style>
        /* Styling untuk dialog box */
        .konversi-box {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #efffbf;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            z-index: 9999;
            display: none;
        }
        .konversi-box h3 {
            margin-top: 0;
        }
    </style>
    
    <style>
        /* Styling untuk dialog box */
        .hari-box {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #efffbf;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            z-index: 9999;
            display: none;
        }
        .hari-box h3 {
            margin-top: 0;
        }
    </style>
    <style>
        /* Styling untuk dialog box */
        .info-box {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #efffbf;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            z-index: 9999;
            display: none;
        }
        .info-box h3 {
            margin-top: 0;
        }
    </style>		
    <style>
        /* Styling untuk ketanggal box */
        .ketanggal-box {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #efffbf;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            z-index: 9999;
            display: none;
        }
        .ketanggal-box h3 {
            margin-top: 0;
        }
        .center {
            text-align: center;
        }
        .kiri {
            text-align: left;
        }
        .kanan {
            text-align: right;
        }	
        .font15 {
            font-size: 15px;
        }
        .font20 {
            font-size: 20px;
        }
        .font25 {
            font-size: 25px;
        }	
		
        input {
          font-size: 15px;
        }
    </style>   
    <style>
      .yellow {
        background-color: rgba(255, 255, 0, 0.3);
      } 
      
      .highlight-yellow {
        background-color: yellow;
        border: 1px solid #fff;
      } 

      .highlight-blue {
        background-color: #99ccff;
        border: 1px solid #fff;
      }
      
      .blue {
        background-color: rgba(0, 0, 255, 0.1);
        border: 1px solid #fff;
        color: yellow;
        font-weight: bold;        
      }
      .biru {
        background-color: #99ccff;
        border: 1px solid #fff;
        color: yellow;
        font-weight: bold;        
      }      
      .highlight-pink {
        background-color: pink;
        border: 1px solid #fff;
      }
      .highlight-green {
        background-color: #dfffbf;
        border: 1px solid #fff;
      }
      .orange {
        background-color: #fff2ff;
        border: 1px solid #fff;
      } 
      .black {
        background-color: #000000;
        color: white;
        font-weight: bold;
        border: 1px solid #fff;
      } 
      .merah {
        background-color: #ff0040;
        color: white;
        font-weight: bold;
        border: 1px solid #fff;
      }      
      .day-text {
        font-size: 20px; /* Atur ukuran teks sesuai kebutuhan */
        font-weight: italic;
      }
     .container {
      text-align: center;
      margin-bottom: 40px;
      }

      #solartime {
        display: block;
      }

      #altelong {
        display: block;
      }

    </style>
    
    <script>
    function gregorianToIslamicDate(gregorianMonth, gregorianDay, gregorianYear) {
      const jd = gregoriantojd(gregorianMonth, gregorianDay, gregorianYear);
      const [islamicYear, islamicMonth, islamicDay] = jdToHijri(jd);
      
      return [islamicYear, islamicMonth, islamicDay];
    }

    function gregoriantojd(month, day, year) {
      const a = Math.floor((14 - month) / 12);
      const y = year + 4800 - a;
      const m = month + 12 * a - 3;
      const jd = day + Math.floor((153 * m + 2) / 5) + 365 * y + Math.floor(y / 4) - Math.floor(y / 100) + Math.floor(y / 400) - 32045;
      return jd;
    }

    function jdToHijri(jd) {
      const l = jd - 1948440 + 10632;
      const n = Math.floor((l - 1) / 10631);
      let lTemp = l - 10631 * n + 354;
      const j = Math.floor((10985 - lTemp) / 5316) * Math.floor(50 * lTemp / 17719) + Math.floor(lTemp / 5670) * Math.floor(43 * lTemp / 15238);
      lTemp = lTemp - Math.floor((30 - j) / 15) * Math.floor((17719 * j) / 50) - Math.floor(j / 16) * Math.floor((15238 * j) / 43) + 29;
      const m = Math.floor(24 * lTemp / 709);
      const d = lTemp - Math.floor(709 * m / 24);
      const adj = 0; // Penyesuaian tanggal hijriyah
      let day = d + adj;
      let month, year;
      
      if (day > 30) {
        day = 1;
        month = m + 1;
        if (month > 12) {
          month = 1;
          year = n + 1;
        } else {
          year = n;
        }
      } else if (day <= 0) {
        month = m - 1;
        if (month <= 0) {
          month = 12;
          year = n - 1;
        } else {
          year = n;
        }
        day = getDaysInMonth(month, getHijriYear(year));
      } else {
        month = m;
        year = n;
      }

      return [getHijriYear(year), month, day]; // Perbaiki pengambilan tahun Hijriyah
    }

    function getDaysInMonth(month, year) {
      const daysInMonth = {
        1: 30,
        2: isLeapYear(year) ? 29 : 28,
        3: 30,
        4: 29,
        5: 30,
        6: 29,
        7: 30,
        8: 29,
        9: year === 2023 ? 29 : 30,    
        10: 29,
        11: 30,
        12: 29
      };

      if (month == 12 && !isLeapYear(year)) {
        return 29;
      }
      
      return daysInMonth[month];
    }


    function isLeapYear(year) {
      return (year % 4 === 0 && year % 100 !== 0) || year % 400 === 0;
    }

    function getHijriYear(n) {
      return Math.floor((n * 354 + 110) / 10631);
    }

    function calculateIslamicYear(gregorianYear) {
      var hijriEpoch = 622;
      var gregorianEpoch = 1582;
      var yearDiff = gregorianYear - gregorianEpoch;
      var correction = Math.floor((yearDiff - 2) / 33);
      var hijriYear = hijriEpoch + yearDiff + correction;
      return hijriYear;
    }
    </script> 
    

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Mendapatkan elemen input
      var latitudeInput = document.getElementById("latitudeInput");
      var longitudeInput = document.getElementById("longitudeInput");
      var elevationInput = document.getElementById("ElevationInput");
      var gmtInput = document.getElementById("GmtInput");

      // Membuat array untuk pilihan beserta harga latitude, longitude, dan elevation
      var pilihan = [
          { nama: "Patemon, Semarang, GMT+7", latitude: -7.067, longitude: 110.4, elevation: 261, gmt: 7 },
          { nama: "Yogyakarta, GMT+7", latitude: -7.797, longitude: 110.371, elevation: 113, gmt: 7 },
          { nama: "Jakarta, GMT+7", latitude: -6.2088, longitude: 106.8456, elevation: 0, gmt: 7 },
          { nama: "Sabang, GMT+7", latitude: 5.893, longitude: 95.32, elevation: 0, gmt: 7 },
          { nama: "Surabaya, GMT+7", latitude: -7.2575, longitude: 112.7521, elevation: 0, gmt: 7 },
          { nama: "Pontianak, GMT+7", latitude: -0.0225, longitude: 109.33, elevation: 0, gmt: 7 },
          { nama: "Palangkaraya, GMT+7", latitude: -2.2097, longitude: 113.9092, elevation: 0, gmt: 7 },
          { nama: "Denpasar, GMT+8", latitude: -8.65, longitude: 115.2167, elevation: 0, gmt: 8 },
          { nama: "Mataram, GMT+8", latitude: -8.5833, longitude: 116.1167, elevation: 0, gmt: 8 },
          { nama: "Kupang, GMT+8", latitude: -10.1628, longitude: 123.5975, elevation: 0, gmt: 8 },
          { nama: "Denpasar, GMT+8", latitude: -8.65, longitude: 115.2167, elevation: 0, gmt: 8 },
          { nama: "Mataram, GMT+8", latitude: -8.5833, longitude: 116.1167, elevation: 0, gmt: 8 },
          { nama: "Kupang, GMT+8", latitude: -10.1628, longitude: 123.5975, elevation: 0, gmt: 8 },
          { nama: "Banjarmasin, GMT+8", latitude: -3.3194, longitude: 114.5908, elevation: 0, gmt: 8 },
          { nama: "Samarinda, GMT+8", latitude: -0.49, longitude: 117.1475, elevation: 0, gmt: 8 },
          { nama: "Manado, GMT+8", latitude: 1.4933, longitude: 124.8413, elevation: 0, gmt: 8 },
          { nama: "Makassar, GMT+8", latitude: -5.1477, longitude: 119.4327, elevation: 0, gmt: 8 },
          { nama: "Kendari, GMT+8", latitude: -3.989, longitude: 122.513, elevation: 0, gmt: 8 },
          { nama: "Palu, GMT+8", latitude: -0.8917, longitude: 119.8707, elevation: 0, gmt: 8 },
          { nama: "Gorontalo, GMT+8", latitude: 0.5375, longitude: 123.0595, elevation: 0, gmt: 8 },
          { nama: "Ambon, GMT+9", latitude: -3.6956, longitude: 128.1814, elevation: 0, gmt: 9 },
          { nama: "Jayapura, GMT+9", latitude: -2.5333, longitude: 140.7167, elevation: 0, gmt: 9 },
          { nama: "---", latitude: 0, longitude: 0, elevation: 0, gmt: 0 },
          { nama: "Wellington, GMT+12", latitude: -41.287, longitude: 174.776, elevation: 0, gmt: 12 },
          { nama: "Auckland, GMT+12", latitude: -36.8485, longitude: 174.7633, elevation: 0, gmt: 12 },
          { nama: "Noumea, GMT+11", latitude: -22.267, longitude: 166.448, elevation: 0, gmt: 11 },
          { nama: "Magadan, GMT+11", latitude: 59.5682, longitude: 150.8086, elevation: 0, gmt: 11 },
          { nama: "Sydney, GMT+10", latitude: -33.8651, longitude: 151.2093, elevation: 0, gmt: 10 },
          { nama: "Port Moresby, GMT+10", latitude: -9.5, longitude: 147.2, elevation: 0, gmt: 10 },
          { nama: "Melbourne, GMT+10", latitude: -37.8, longitude: 144.96, elevation: 0, gmt: 10 },
          { nama: "Seoul, GMT+9", latitude: 37.5665, longitude: 126.978, elevation: 0, gmt: 9 },
          { nama: "Tokyo, GMT+9", latitude: 35.6762, longitude: 139.6503, elevation: 0, gmt: 9 },
          { nama: "Beijing, GMT+8", latitude: 39.9042, longitude: 116.4074, elevation: 0, gmt: 8 },
          { nama: "Bangkok, GMT+7", latitude: 13.7563, longitude: 100.5018, elevation: 0, gmt: 7 },
          { nama: "Dhaka, GMT+6", latitude: 23.8103, longitude: 90.4125, elevation: 0, gmt: 6 },
          { nama: "Mumbai, GMT+5:30", latitude: 19.076, longitude: 72.8777, elevation: 0, gmt: 5.5 },
          { nama: "Delhi, GMT+5:30", latitude: 28.6139, longitude: 77.209, elevation: 0, gmt: 5.5 },
          { nama: "Islamabad, GMT+5", latitude: 33.6844, longitude: 73.0479, elevation: 0, gmt: 5 },
          { nama: "Dubai, GMT+4", latitude: 25.205, longitude: 55.271, elevation: 0, gmt: 4 },
          { nama: "Kabul, GMT+3.5", latitude: 34.555, longitude: 69.208, elevation: 0, gmt: 3.5 },
          { nama: "Doha, GMT+3", latitude: 25.285, longitude: 51.531, elevation: 0, gmt: 3 },
          { nama: "Makkah, GMT+3", latitude: 21.389, longitude: 39.858, elevation: 0, gmt: 3 },
          { nama: "Madinah, GMT+3", latitude: 24.525, longitude: 39.569, elevation: 0, gmt: 3 },
          { nama: "Damaskus, GMT+3", latitude: 33.514, longitude: 36.277, elevation: 0, gmt: 3 },
          { nama: "Istanbul, GMT+3", latitude: 41.0082, longitude: 28.9784, elevation: 0, gmt: 3 },
          { nama: "Ankara, GMT+3", latitude: 39.933, longitude: 32.86, elevation: 0, gmt: 3 },
          { nama: "Moskow, GMT+3", latitude: 55.75, longitude: 37.62, elevation: 0, gmt: 3 },
          { nama: "Johannesburg, GMT+2", latitude: -26.2041, longitude: 28.0473, elevation: 0, gmt: 2 },
          { nama: "Rome, GMT+2", latitude: 41.9028, longitude: 12.4964, elevation: 0, gmt: 2 },
          { nama: "Cairo, GMT+2", latitude: 30.0444, longitude: 31.2357, elevation: 0, gmt: 2 },
          { nama: "Athens, GMT +2", latitude: 7.984, longitude: 23.728, elevation: 0, gmt: 2 },
          { nama: "Cape Town, GMT +2", latitude: -33.925, longitude: 18.424, elevation: 0, gmt: 2 },
          { nama: "Paris, GMT+2", latitude: 48.857, longitude: 2.352, elevation: 0, gmt: 2 },
          { nama: "Madrid, GMT+2", latitude: 40.4168, longitude: -3.7038, elevation: 0, gmt: 2 },
          { nama: "Innsbruck, GMT+1", latitude: 47.269, longitude: 11.404, elevation: 0, gmt: 1 },

          { nama: "Berlin, GMT+1", latitude: 52.52, longitude: 13.405, elevation: 0, gmt: 1 },
          { nama: "London, GMT", latitude: 51.507, longitude: 0.128, elevation: 0, gmt: 0 },
          { nama: "Greenwich, GMT", latitude: 51.482, longitude: 0.008, elevation: 0, gmt: 0 },
          { nama: "Azores, GMT-0", latitude: 37.7412, longitude: -25.6752, elevation: 0, gmt: 0 },
           
          { nama: "Cape Verde, GMT-1", latitude: 15.1201, longitude: -23.6052, elevation: 0, gmt: -1 },
          { nama: "Fernando de Noronha, GMT-2", latitude: -3.8400, longitude: -32.4200, elevation: 0, gmt: -2 },
          { nama: "Buenos Aires, GMT-3", latitude: -34.6037, longitude: -58.3816, elevation: 0, gmt: -3 },
          { nama: "Rio de Janeiro, GMT-3", latitude: -22.9068, longitude: -43.1729, elevation: 0, gmt: -3 },
          { nama: "New York City, GMT-4", latitude: 40.7128, longitude: -74.0060, elevation: 0, gmt: -4 },
          { nama: "Toronto, GMT-4", latitude: 43.6510, longitude: -79.3470, elevation: 0, gmt: -4 },
          { nama: "Mexico City, GMT-5", latitude: 19.4326, longitude: -99.1332, elevation: 0, gmt: -5 },
          { nama: "Edmonton, GMT-6", latitude: 53.5461, longitude: -113.4938, elevation: 0, gmt: -6 },
          { nama: "Los Angeles, GMT-7", latitude: 34.0522, longitude: -118.2437, elevation: 0, gmt: -7 },
          { nama: "Anchorage, GMT-8", latitude: 61.2181, longitude: -149.9003, elevation: 0, gmt: -8 },
          { nama: "Gambier Islands, GMT-9", latitude: -23.1324, longitude: -134.9703, elevation: 0, gmt: -9 },
          { nama: "Hawaii, GMT-10", latitude: 19.8968, longitude: -155.5828, elevation: 0, gmt: -10 },
          { nama: "Honolulu, GMT-10", latitude: 21.317, longitude: -157.867, elevation: 0, gmt: -10 },
          { nama: "Midway Atoll, GMT-11", latitude: 28.2019, longitude: -177.3785, elevation: 0, gmt: -11 },
          { nama: "Baker Island, GMT-12", latitude: 0.1936, longitude: -176.4760, elevation: 0, gmt: -12 }
      ];  

      // Membuat elemen select   
      var select = document.createElement("select");

      // Membuat dan menambahkan pilihan pada select
      for (var i = 0; i < pilihan.length; i++) {
        var option = document.createElement("option");
        option.value = i;
        option.text = pilihan[i].nama;
        select.appendChild(option);
      }   

      // Menambahkan event listener pada select untuk mengubah nilai input
      select.addEventListener("change", function() {
        var selectedIndex = select.options[select.selectedIndex].value;
        latitudeInput.value = pilihan[selectedIndex].latitude;
        longitudeInput.value = pilihan[selectedIndex].longitude;
        elevationInput.value = pilihan[selectedIndex].elevation;
        gmtInput.value = pilihan[selectedIndex].gmt;
      });

      // Menambahkan select ke dalam dokumen
      var container = document.getElementById("container");
      container.appendChild(select);
    });
</script>


  <script> 
      function subtractGMT(time, offset) {
        // Memisahkan jam, menit, dan detik dari waktu
        const [hours, minutes, seconds] = time.split(':').map(Number);

        // Menghitung total detik dari waktu
        const totalSeconds = hours * 3600 + minutes * 60 + seconds;

        // Menghitung total detik setelah dikurangi offset GMT
        let adjustedSeconds = totalSeconds - (7 - offset) * 3600;

        // Menghindari waktu bernilai negatif
        if (adjustedSeconds < 0) {
          adjustedSeconds += 24 * 3600; // Menambahkan 24 jam dalam detik
        }

        // Menghitung kembali jam, menit, dan detik baru
        const adjustedHours = Math.floor(adjustedSeconds / 3600) % 24;
        const adjustedMinutes = Math.floor((adjustedSeconds % 3600) / 60);
        const adjustedSecondsRemainder = adjustedSeconds % 60;

        // Mengatur format HH:mm:ss dengan leading zero jika diperlukan
        const formattedTime = `${String(adjustedHours).padStart(2, '0')}:${String(adjustedMinutes).padStart(2, '0')}:${String(adjustedSecondsRemainder).padStart(2, '0')}`;

        return formattedTime;
      }
  </script>
  
  <script src="https://blogchem.com/moonphase/astronomy.browser.js"></script>
  <script src="https://blogchem.com/moonphase/PrayTimes.js"></script> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/suncalc/1.8.0/suncalc.min.js"></script>
  <script src="https://momentjs.com/downloads/moment.js"></script>
  <script type="text/javascript" src="https://blogchem.com/moonphase/mooncalc.js"></script>
</head>
<body>

  <div class="center">
    <h2>KALENDER SEPANJANG MASA</h2>
    <div style="text-align: center; border: 0px; background-color: #fff; padding: 5px;">
        <span class="font15" style="font-weight: bold;" id="container"></span>
        <label class="font15" for="latitudeInput" size="5" >Latitude:</label>
        <input class="font15" type="number" id="latitudeInput" step="0.001" placeholder="Latitude" value="-7.067" size="5" >

        <label class="font15" for="longitudeInput">Longitude:</label>
        <input class="font15" type="number" id="longitudeInput" step="0.001" placeholder="Longitude" value="110" size="5" > 

        <label class="font15" for="ElevationInput">Elevation:</label>    
        <input class="font15" type="number" id="ElevationInput" value="261" size="5" >
        <label class="font15" for="ElevationInput">GMT:</label><input class="font15"  type="text" id="GmtInput" pattern="[\-\+]?\d+(\.\d*)?" size="5" value="7"  class="data">
    </div> 
  
    <label for="startYear" class="font15">Tahun Awal:</label>
    <input class="tahun" type="number" id="startYear" name="startYear" value="">
    &nbsp;&nbsp;<label for="endYear" class="font15">Tahun Akhir:</label>
    <input class="tahun" type="number" id="endYear" name="endYear">
    &nbsp;&nbsp;<button onclick="createCalendar(); getSunsetTime()">Buat Kalender</button>
  </div>
  
  <hr/>
  <center>
    <small><a href="https://blogchem.com/moonphase/" target="_blank" title="Info Moonphase"><button>MoonPhase</button></a>&nbsp;&nbsp;<a href="https://blogchem.com/moonphase/rashdulkiblat.php" target="_blank"><button>Kiblat</button></a>&nbsp;&nbsp;<a href="https://blogchem.com/moonphase/shalat.php" target="_blank"><button>Shalat</button></a>&nbsp;&nbsp;<button title="Konversi tanggal Masehi ke Hijriyah dan dina pasaran." onclick="showDialog()">Konversi</button>&nbsp;&nbsp;<a href="https://blogchem.com/kalender/" target="_blank"><button title="Kalender Masehi dan Hijriyah berdasarkan data astronomis">Kalender & Info</button></a></small> 
  </center>
  <br/>
  <!--
  
   <hr/>
   <span id="solartime"></span>
   <br/>
   <span id="altelong"></span>
   -->
  <div class="calendar-container"></div>

  <script>
    function createCalendar() {
      const latitude = parseFloat(document.getElementById('latitudeInput').value);
      const longitude = parseFloat(document.getElementById('longitudeInput').value);
      const elevation = parseFloat(document.getElementById('ElevationInput').value);
      const gmt = parseFloat(document.getElementById('GmtInput').value); 

      var startYearInput = document.getElementById('startYear');
      var endYearInput = document.getElementById('endYear');
      
      var startYear = parseInt(startYearInput.value) || currentYear;
      var endYear = parseInt(endYearInput.value) || startYear;
      var currentYear = new Date().getFullYear();


      if (isNaN(startYear) || isNaN(endYear)) {
        alert('Mohon masukkan angka untuk Tahun Awal dan Tahun Akhir');
        return;
      }

      if (endYear < startYear) {
        alert('Tahun Akhir tidak boleh lebih kecil dari Tahun Awal');
        return;
      }

      startYear = startYear || currentYear;
      endYear = endYear || currentYear || startYear;
      var calendarContainer = document.querySelector('.calendar-container');

      calendarContainer.innerHTML = ''; // Menghapus kalender sebelumnya (jika ada)
      
      
      var wrapperContainer = document.createElement('div');
      wrapperContainer.style.display = 'flex';
      wrapperContainer.style.flexDirection = 'column';
      wrapperContainer.style.alignItems = 'center';
      wrapperContainer.style.marginBottom = '20px';
      calendarContainer.appendChild(wrapperContainer);

      var solarTimeContainer = document.createElement('div');
      solarTimeContainer.id = 'solartime';
      solarTimeContainer.style.textAlign = 'center';
      solarTimeContainer.style.fontSize = "15px";
      wrapperContainer.appendChild(solarTimeContainer);
      

      var sunsetContainer = document.createElement('div');
      sunsetContainer.style.display = 'flex';
      sunsetContainer.style.flexDirection = 'column';
      sunsetContainer.style.alignItems = 'center';
      sunsetContainer.style.marginBottom = '20px';
      calendarContainer.appendChild(sunsetContainer);
      
      var altelongContainer = document.createElement('div');
      altelongContainer.id = 'sunset';
      altelongContainer.style.textAlign = 'center';
      altelongContainer.style.fontSize = "15px";
      sunsetContainer.appendChild(altelongContainer); 
 
      for (var year = startYear; year <= endYear; year++) {
        for (var month = 1; month <= 12; month++) {
          var daysInMonth = new Date(year, month, 0).getDate();
          var monthName = new Date(year, month - 1).toLocaleDateString('id-ID', { month: 'long' });     
          
          var monthContainer = document.createElement('div');
          monthContainer.className = 'month-container';

          var monthTitle = document.createElement('div');
          monthTitle.className = 'month-title';
          monthTitle.textContent = monthName + ' ' + year;
          monthContainer.appendChild(monthTitle);
          

          var calendarTable = document.createElement('table');
          calendarTable.className = 'calendar-table';

          var weekdayHeaderRow = document.createElement('tr');
          var weekdays = ['AHAD', 'SENIN', 'SELASA', 'RABU', 'KAMIS', 'JUMAT', 'SABTU'];
          for (var i = 0; i < weekdays.length; i++) {
            var weekdayHeaderCell = document.createElement('th');
            weekdayHeaderCell.textContent = weekdays[i];
            if (weekdays[i] === 'AHAD') {
              weekdayHeaderCell.classList.add('sunday');
            } else if (weekdays[i] === 'JUMAT') {
              weekdayHeaderCell.classList.add('friday');
            }
            weekdayHeaderRow.appendChild(weekdayHeaderCell);
          }
          calendarTable.appendChild(weekdayHeaderRow);
          


          var currentDate = new Date(year, month - 1, 1);
          var firstDayIndex = currentDate.getDay();

          var day = 1;
          var calendarRow = document.createElement('tr');
          for (var i = 0; i < 7; i++) {
            if (i < firstDayIndex) {
              var emptyCell = document.createElement('td');
              calendarRow.appendChild(emptyCell);
            } else if (day <= daysInMonth) {
              var calendarCell = document.createElement('td');

              var dateText = document.createElement('div');
              dateText.textContent = day;
              calendarCell.appendChild(dateText);

              var pasaranText = document.createElement('div');          
              var pasaran = calculatePasaran(day, month, year);
              pasaranText.textContent = pasaran;
              calendarCell.appendChild(pasaranText);

              var islamcalText = document.createElement('div');
              const [islamic_year, islamic_month, islamic_day] = gregorianToIslamicDate(month, day, year);
              var islamicYear = calculateIslamicYear(year);
              var islamcal = islamic_day+'/'+islamic_month;              
              islamcalText.textContent = islamcal;
              calendarCell.appendChild(islamcalText);
              
 
                if (weekdays[i] === 'AHAD') {
                  calendarCell.classList.add('red');
                } else if (weekdays[i] === 'JUMAT') {
                  calendarCell.classList.add('green');
                }

                // Tambahkan kode berikut untuk menandai tanggal 1/9 (1 Ramadhan) dan 1/10 (1 Syawal)

                if (day === 21 && month === 4 && year === 2023) {
                    calendarCell.classList.add('highlight-yellow'); 
                    calendarCell.setAttribute('title', 'Hari Idul Fitri versi Muhammadiyah');
                  } else if (islamic_day === 29) {
                    calendarCell.classList.add('yellow'); 
                    //calendarCell.appendChild(date);
                    calendarCell.setAttribute('title', 'New Moon');
                  } else if (day === 2 && month === 5) {
                    calendarCell.style.backgroundColor = 'lightblue'; 
                    calendarCell.style.border = '1px solid blue'; 
                    calendarCell.setAttribute('title', 'Hardiknas');   
                  } else if (day === 28 && month === 6 && year === 2023) {
                    calendarCell.classList.add('highlight-pink'); 
                    calendarCell.setAttribute('title', 'Hari Arafah/Hari Idul Adha versi Muhammadiyah');  
                  } else if (day === 27 && month === 6 && year === 2023) {
                    calendarCell.classList.add('highlight-pink'); 
                    calendarCell.setAttribute('title', 'Hari Arafah versi Muhammadiyah');  
                  } else if (day === 17 && month === 8) {
                    calendarCell.classList.add('merah'); 
                    calendarCell.setAttribute('title', 'Hari Kemerdekaan NKRI');  
                  } else if (islamic_month === 1 && islamic_day === 1) {
                    calendarCell.classList.add('black'); 
                    calendarCell.setAttribute('title', 'Awal Tahun Hijriyah');
                  } else if (islamic_month === 9) {
                    calendarCell.classList.add('highlight-green'); 
                    calendarCell.setAttribute('title', 'Puasa Ramadhan');
                  } else if (islamic_month === 10 && islamic_day === 1) {
                    calendarCell.classList.add('highlight-yellow'); 
                    calendarCell.setAttribute('title', 'Hari Idul Fitri');
                  } else if (islamic_month === 12 && islamic_day === 10) {
                    calendarCell.classList.add('highlight-pink'); 
                    calendarCell.setAttribute('title', 'Hari Idul Adha');
                  } else if (islamic_month === 12 && islamic_day === 9) {
                    calendarCell.classList.add('highlight-pink'); 
                    calendarCell.setAttribute('title', 'Hari Arafah');  
                  } else if ((islamic_month === 12) && (islamic_day === 11 || islamic_day === 12 || islamic_day === 13)) {
                    calendarCell.classList.add('highlight-pink'); 
                    calendarCell.setAttribute('title', 'Hari Tasyrik');                    
                  } else if ((islamic_month != 12) && (islamic_day === 13 || islamic_day === 14 || islamic_day === 15)) {
                    calendarCell.classList.add('orange'); 
                    calendarCell.setAttribute('title', 'Ayyamul Bidh');
                  } else if (islamic_month === 1 && islamic_day === 10) {
                    calendarCell.classList.add('highlight-blue'); 
                    calendarCell.setAttribute('title', 'Hari Asyura');
                  } else if (islamic_month === 7 && islamic_day === 27) {
                    calendarCell.classList.add('highlight-blue'); 
                    calendarCell.setAttribute('title', 'Hari Isra Miraj');
                  }   
                

                // Check if the current cell represents today's date
                var today = new Date();
                if (today.getDate() === day && today.getMonth() === month - 1 && today.getFullYear() === year) {
                  calendarCell.style.backgroundColor = 'highlight-blue'; 
                  calendarCell.style.border = '1px solid blue'; 
                  calendarCell.setAttribute('title', 'Hari ini (current day)');
                }

              calendarRow.appendChild(calendarCell);
              day++;
            }
          }
          calendarTable.appendChild(calendarRow);

          while (day <= daysInMonth) {
            var newCalendarRow = document.createElement('tr');
            for (var i = 0; i < 7; i++) {
              if (day <= daysInMonth) {
                var calendarCell = document.createElement('td');
                            
                var dateText = document.createElement('div');
                dateText.textContent = day;
                dateText.classList.add('day-text'); 
                calendarCell.appendChild(dateText);

                var pasaranText = document.createElement('div');
                var pasaran = calculatePasaran(day, month, year);
                pasaranText.textContent = pasaran;
                calendarCell.appendChild(pasaranText);

                var islamcalText = document.createElement('div');
                const [islamic_year, islamic_month, islamic_day] = gregorianToIslamicDate(month, day, year);
                var islamcal = islamic_day+'/'+islamic_month;              
                islamcalText.textContent = islamcal;
                calendarCell.appendChild(islamcalText);  
                
                
                if (weekdays[i] === 'AHAD') {
                  calendarCell.classList.add('red');
                } else if (weekdays[i] === 'JUMAT') {
                  calendarCell.classList.add('green');
                }

                // Tambahkan kode berikut untuk menandai tanggal 1/9 (1 Ramadhan) dan 1/10 (1 Syawal)

                if (day === 21 && month === 4 && year === 2023) {
                    calendarCell.classList.add('highlight-yellow'); 
                    calendarCell.setAttribute('title', 'Hari Idul Fitri versi Muhammadiyah');
                  } else if (islamic_day === 29) {
                    calendarCell.classList.add('yellow'); 
                    //calendarCell.appendChild(date);
                    calendarCell.setAttribute('title', 'New Moon');
                  } else if (day === 2 && month === 5) {
                    calendarCell.style.backgroundColor = 'lightblue'; 
                    calendarCell.style.border = '1px solid blue'; 
                    calendarCell.setAttribute('title', 'Hardiknas');   
                  } else if (day === 28 && month === 6 && year === 2023) {
                    calendarCell.classList.add('highlight-pink'); 
                    calendarCell.setAttribute('title', 'Hari Arafah/Hari Idul Adha versi Muhammadiyah');  
                  } else if (day === 27 && month === 6 && year === 2023) {
                    calendarCell.classList.add('highlight-pink'); 
                    calendarCell.setAttribute('title', 'Hari Arafah versi Muhammadiyah');  
                  } else if (day === 17 && month === 8) {
                    calendarCell.classList.add('merah'); 
                    calendarCell.setAttribute('title', 'Hari Kemerdekaan NKRI');  
                  } else if (islamic_month === 1 && islamic_day === 1) {
                    calendarCell.classList.add('black'); 
                    calendarCell.setAttribute('title', 'Awal Tahun Hijriyah');
                  } else if (islamic_month === 9) {
                    calendarCell.classList.add('highlight-green'); 
                    calendarCell.setAttribute('title', 'Puasa Ramadhan');
                  } else if (islamic_month === 10 && islamic_day === 1) {
                    calendarCell.classList.add('highlight-yellow'); 
                    calendarCell.setAttribute('title', 'Hari Idul Fitri');
                  } else if (islamic_month === 12 && islamic_day === 10) {
                    calendarCell.classList.add('highlight-pink'); 
                    calendarCell.setAttribute('title', 'Hari Idul Adha');
                  } else if (islamic_month === 12 && islamic_day === 9) {
                    calendarCell.classList.add('highlight-pink'); 
                    calendarCell.setAttribute('title', 'Hari Arafah');  
                  } else if ((islamic_month === 12) && (islamic_day === 11 || islamic_day === 12 || islamic_day === 13)) {
                    calendarCell.classList.add('highlight-pink'); 
                    calendarCell.setAttribute('title', 'Hari Tasyrik');                    
                  } else if ((islamic_month != 12) && (islamic_day === 13 || islamic_day === 14 || islamic_day === 15)) {
                    calendarCell.classList.add('orange'); 
                    calendarCell.setAttribute('title', 'Ayyamul Bidh');
                  } else if (islamic_month === 1 && islamic_day === 10) {
                    calendarCell.classList.add('highlight-blue'); 
                    calendarCell.setAttribute('title', 'Hari Asyura');
                  } else if (islamic_month === 7 && islamic_day === 27) {
                    calendarCell.classList.add('highlight-blue'); 
                    calendarCell.setAttribute('title', 'Hari Isra Miraj');
                  }   
                

                // Check if the current cell represents today's date
                var today = new Date();
                if (today.getDate() === day && today.getMonth() === month - 1 && today.getFullYear() === year) {
                  calendarCell.style.backgroundColor = 'highlight-blue'; 
                  calendarCell.style.border = '1px solid blue'; 
                  calendarCell.setAttribute('title', 'Hari ini (current day)');
                }



                newCalendarRow.appendChild(calendarCell);
                day++;
              }
            }
            calendarTable.appendChild(newCalendarRow);
          }

          monthContainer.appendChild(calendarTable);
          calendarContainer.appendChild(monthContainer);
        }
      }
    }

    function FormatCoord(x) {
        return x.toFixed(2);
    }

    function getSunsetTime() {
      const latitude = parseFloat(document.getElementById('latitudeInput').value);
      const longitude = parseFloat(document.getElementById('longitudeInput').value);

      if (isNaN(latitude) || isNaN(longitude)) {
        alert("Mohon masukkan latitude dan longitude yang valid.");
        return;
      }

      const url = `https://api.sunrise-sunset.org/json?lat=${latitude}&lng=${longitude}&formatted=0`;
      fetch(url)
        .then(response => response.json())
        .then(data => {
          
		  const sunrise = new Date(data.results.sunrise);
		  const sunset = new Date(data.results.sunset);
		  const solar_noon = new Date(data.results.solar_noon);
		  const day_length = new Date(data.results.day_length);
          var date = new Date();
        
          //var moon_alt = FormatCoord(hor.altitude);

          var PT = new PrayTimes('MU');
          var times = PT.getTimes(date, [latitude, longitude]);
          var midnight = times.midnight;
          
          var elongation = Astronomy.AngleFromSun(Astronomy.Body.Moon, sunset);
          elongation = elongation.toFixed(2);
          
          let moonPos = SunCalc.getMoonPosition(sunset, latitude, longitude);
          let moonAltitude = moonPos.altitude * 180 / Math.PI;
          moonAltitude = moonAltitude.toFixed(2);
          
          const formattedSunrise = getFormattedDateTime(sunrise);
		  const formattedSunset = getFormattedDateTime(sunset);
		  const formattedSolarnoon = getFormattedDateTime(solar_noon);
		  const formattedDaylength = getFormattedDateTime(day_length);
		  const solarTime = `Sun rise: ${formattedSunrise} / Sun transit: ${formattedSolarnoon} / Sun set: ${formattedSunset} \n Midnight: ${midnight} / Altitude: ${moonAltitude} / Elongation: ${elongation}`;

          
          return document.getElementById("solartime").innerText = solarTime;

          
        })
        .catch(error => {
          console.error("Terjadi kesalahan:", error);       
        });
    }


    function FormatCoord(coord) {      
      return coord.toFixed(2);   
    }

    function getFormattedDateTime(date) {
      const year = date.getFullYear();
      const month = padZero(date.getMonth() + 1);
      const day = padZero(date.getDate());
      const hour = padZero(date.getHours());
      const minute = padZero(date.getMinutes());
      const second = padZero(date.getSeconds());
      return `${year}-${month}-${day} ${hour}:${minute}:${second}`;
    }

    function padZero(value) {
      return value.toString().padStart(2, '0');
    }


    function calculatePasaran(day, month, year) {
      var d = day;
      var m = month - 1;
      var y = year;

      var pasaranNames = ["Pahing", "Pon", "Wage", "Kliwon", "Legi"];
      var jumlahHari = Math.floor((new Date(y, m, d) - new Date(1900, 0, 1)) / (1000 * 60 * 60 * 24));
      var sisaHari = jumlahHari % 35;
      var pasaranIndex = sisaHari % 5;
      return pasaranNames[pasaranIndex];
    } 

    // Set nilai default untuk input "Tahun Awal" dengan nilai currentYear
    document.getElementById('startYear').value = new Date().getFullYear();

    // Tampilkan kalender untuk currentYear secara otomatis
    createCalendar();
  </script>
  
  





  <div class="dialog-box" id="dialog-box">
      <?php
        include "https://blogchem.com/moonphase/inputkalender.php";
      ?>
      <button onclick="hideDialog()">Tutup</button>
  </div>
  <script>
      // Fungsi untuk menampilkan dialog box
      function showDialog() {
          document.getElementById("dialog-box").style.display = "block";
      }

      // Fungsi untuk menyembunyikan dialog box
      function hideDialog() {
          document.getElementById("dialog-box").style.display = "none";
      }
  </script>   
  
  <div class="konversi-box" id="konversi-box">
      <?php
        include "https://blogchem.com/moonphase/h2m.php";
      ?>
      <button onclick="hideKonversi()">Tutup</button>
  </div>
  <script>
      // Fungsi untuk menampilkan dialog box
      function showKonversi() {
          document.getElementById("konversi-box").style.display = "block";
      }

      // Fungsi untuk menyembunyikan dialog box
      function hideKonversi() {
          document.getElementById("konversi-box").style.display = "none";
      }
  </script>  	

  <div class="hari-box" id="hari-box">
      <?php
        include "https://blogchem.com/moonphase/hitunghari.php";
      ?>
      <button onclick="hideHari()">Tutup</button>
  </div>
  <script>
      // Fungsi untuk menampilkan dialog box
      function showHari() {
          document.getElementById("hari-box").style.display = "block";
      }

      // Fungsi untuk menyembunyikan dialog box
      function hideHari() {
          document.getElementById("hari-box").style.display = "none";
      }
  </script> 

  <div class="ketanggal-box" id="ketanggal-box">
      <?php
        include "https://blogchem.com/moonphase/ketanggal.php";
      ?>
      <button onclick="hideKetanggal()">Tutup</button>
  </div>
  <script>
      // Fungsi untuk menampilkan dialog box
      function showKetanggal() {
          document.getElementById("ketanggal-box").style.display = "block";
      }

      // Fungsi untuk menyembunyikan dialog box
      function hideKetanggal() {
          document.getElementById("ketanggal-box").style.display = "none";
      }
  </script> 
  <p style="text-align: center;"><span style="text-align: justify; font-size: 15px;"><b>Nama Bulan Hijriyah:</b><br/>
  1) Muharam, 2) Shafar, 3) Rabiul awal, 4) Rabiul akhir, 5) Jumadil awal, 6) Jumadil akhir, 7) Rajab, 8) Syaban, 9) Ramadhan, 10) Syawal, 11) Dzulqoidah, 12) Dzulhijah</span></p>
  <center>                  
      <p style="text-align: center;">  
      <hr/>
          <span style="text-align: center; font-size: 15px;">Copyleft (ɔ) Kasmui, ChatGPT, Chatbot Bing & Bard Google, 2023. All Wrongs Reserved.</span>
      </p>
  </center>  
</body>
</html>

<div id="preloader">
   <!--<div id="status" style="top: 20%;">-->
   <!--   <div class="spinner-chase">-->
   <!--      <div class="chase-dot"></div>-->
   <!--      <div class="chase-dot"></div>-->
   <!--      <div class="chase-dot"></div>-->
   <!--      <div class="chase-dot"></div>-->
   <!--      <div class="chase-dot"></div>-->
   <!--      <div class="chase-dot"></div>-->
   <!--   </div>-->
   <!--</div>-->
    <style>
        .loaderColor {
            border: 16px solid {{ App\Helpers\DayConfig::getColor() }};
            border-radius: 50%;
            border-top: 16px solid #fff;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite; /* Safari */
            animation: spin 2s linear infinite;
        }
        /* Safari */
        @-webkit-keyframes spin {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .loaderContainer{
            position: absolute; 
            top: 50%; 
            left: 50%; 
            transform: translate(-50%, -50%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
    </style>

    <div class="loaderContainer">
        <div class="loaderColor"></div>
        <img src="{{ App\Helpers\DayConfig::getLoader() }}" />
    </div>

</div>
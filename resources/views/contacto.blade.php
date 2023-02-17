<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
        <style type="text/css">@font-face{
            font-family:'Montserrat';
            font-style:normal;
            font-weight:200;
            font-display:swap;
            src:url(https://fonts.gstatic.com/s/montserrat/v25/JTUHjIg1_i6t8kCHKm4532VJOt5-QNFgpCvr6Hw0aXx-p7K4KLjztg.woff) format('woff');
            unicode-range:U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        }
        @font-face{
            font-family:'Montserrat';
            font-style:normal;
            font-weight:200;
            font-display:swap;
            src:url(https://fonts.gstatic.com/s/montserrat/v25/JTUHjIg1_i6t8kCHKm4532VJOt5-QNFgpCvr6Hw9aXx-p7K4KLjztg.woff) format('woff');
            unicode-range:U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        }
        @font-face{
            font-family:'Montserrat';
            font-style:normal;
            font-weight:200;
            font-display:swap;
            src:url(https://fonts.gstatic.com/s/montserrat/v25/JTUHjIg1_i6t8kCHKm4532VJOt5-QNFgpCvr6Hw2aXx-p7K4KLjztg.woff) format('woff');
            unicode-range:U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
        }
        @font-face{
            font-family:'Montserrat';
            font-style:normal;
            font-weight:200;
            font-display:swap;
            src:url(https://fonts.gstatic.com/s/montserrat/v25/JTUHjIg1_i6t8kCHKm4532VJOt5-QNFgpCvr6Hw3aXx-p7K4KLjztg.woff) format('woff');
            unicode-range:U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        } 
        @font-face{
            font-family:'Montserrat';
            font-style:normal;
            font-weight:200;
            font-display:swap;
            src:url(https://fonts.gstatic.com/s/montserrat/v25/JTUHjIg1_i6t8kCHKm4532VJOt5-QNFgpCvr6Hw5aXx-p7K4KLg.woff) format('woff');
            unicode-range:U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }</style>

        <style type="text/css">
            h1{
               font-family:'Montserrat';
               font-size: 1.5em;
                font-weight: bold;
            }
            p{
                font-family:'Montserrat';
                font-size: 1em;
            }
        </style>
    </head>
    <body>
        <h1>Mensaje de  {{$name}}</h1>
        <p>Telefono: {{$telefono}}</p>
        <p>Email: {{$email}}</p>
        <p>Mensaje: </p>
        <p>{{$mensaje}}</p>
    </body>
</html>
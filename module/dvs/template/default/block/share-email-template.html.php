<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width">
  <style>
    /**********************************************
    * Ink v1.0.5 - Copyright 2013 ZURB Inc        *
    **********************************************/

    /* Client-specific Styles & Reset */

    #outlook a{l}
    padding:0;
    {r}

    body{l}
      width:100% !important;
      min-width: 100%;
      -webkit-text-size-adjust:100%;
      -ms-text-size-adjust:100%;
      margin:0;
      padding:0;
    {r}

    .ExternalClass{l}
    width:100%;
    {r}

    .ExternalClass,
    .ExternalClass p,
    .ExternalClass span,
    .ExternalClass font,
    .ExternalClass td,
    .ExternalClass div{l}
    line-height: 100%;
    {r}

    #backgroundTable{l}
    margin:0;
    padding:0;
    width:100% !important;
    line-height: 100% !important;
    {r}

    img{l}
    outline:none;
    text-decoration:none;
    -ms-interpolation-mode: bicubic;
    /*width: auto;*/
    max-width: 100%;
    float: left;
    clear: both;
    display: block;
    {r}

    center{l}
    width: 100%;
    min-width: 500px;
    {r}

    a img{l}
    border: none;
    {r}

    p{l}
    margin: 0 0 0 10px;
    {r}

    table{l}
    border-spacing: 0;
    border-collapse: collapse;
    {r}

    td{l}
    word-break: break-word;
    -webkit-hyphens: auto;
    -moz-hyphens: auto;
    hyphens: auto;
    border-collapse: collapse !important;
    {r}

    table, tr, td{l}
    padding: 0;
    vertical-align: top;
    text-align: left;
    {r}

    hr{l}
    color: #d9d9d9;
    background-color: #d9d9d9;
    height: 1px;
    border: none;
    {r}

    /* Responsive Grid */

    table.body{l}
    height: 100%;
    width: 100%;
    {r}

    table.container{l}
    width: 500px;
    margin: 0 auto;
    text-align: inherit;
    {r}

    table.row{l}
    padding: 0px;
    width: 100%;
    position: relative;
    {r}

    table.container table.row{l}
    display: block;
    {r}

    td.wrapper{l}
    padding: 10px 20px 0px 0px;
    position: relative;
    {r}

    table.columns,
    table.column{l}
    margin: 0 auto;
    {r}

    table.columns td,
    table.column td{l}
    padding: 0px 0px 10px;
    {r}

    table.columns td.sub-columns,
    table.column td.sub-columns,
    table.columns td.sub-column,
    table.column td.sub-column{l}
    padding-right: 10px;
    {r}

    td.sub-column, td.sub-columns{l}
    min-width: 0px;
    {r}

    table.row td.last,
    table.container td.last{l}
    padding-right: 0px;
    {r}

    table.one{l} width: 30px;{r}
    table.two{l} width: 80px;{r}
    table.three{l} width: 130px;{r}
    table.four{l} width: 180px;{r}
    table.five{l} width: 230px;{r}
    table.six{l} width: 280px;{r}
    table.seven{l} width: 330px;{r}
    table.eight{l} width: 380px;{r}
    table.nine{l} width: 430px;{r}
    table.ten{l} width: 480px;{r}
    table.eleven{l} width: 530px;{r}
    table.twelve{l} width: 500px;{r}

    table.one center{l} min-width: 30px;{r}
    table.two center{l} min-width: 80px;{r}
    table.three center{l} min-width: 130px;{r}
    table.four center{l} min-width: 180px;{r}
    table.five center{l} min-width: 230px;{r}
    table.six center{l} min-width: 280px;{r}
    table.seven center{l} min-width: 330px;{r}
    table.eight center{l} min-width: 380px;{r}
    table.nine center{l} min-width: 430px;{r}
    table.ten center{l} min-width: 480px;{r}
    table.eleven center{l} min-width: 530px;{r}
    table.twelve center{l} min-width: 500px;{r}

    table.one .panel center{l} min-width: 10px;{r}
    table.two .panel center{l} min-width: 60px;{r}
    table.three .panel center{l} min-width: 110px;{r}
    table.four .panel center{l} min-width: 160px;{r}
    table.five .panel center{l} min-width: 210px;{r}
    table.six .panel center{l} min-width: 260px;{r}
    table.seven .panel center{l} min-width: 310px;{r}
    table.eight .panel center{l} min-width: 360px;{r}
    table.nine .panel center{l} min-width: 410px;{r}
    table.ten .panel center{l} min-width: 460px;{r}
    table.eleven .panel center{l} min-width: 510px;{r}
    table.twelve .panel center{l} min-width: 560px;{r}

    .body .columns td.one,
    .body .column td.one{l} width: 8.333333%;{r}
    .body .columns td.two,
    .body .column td.two{l} width: 16.666666%;{r}
    .body .columns td.three,
    .body .column td.three{l} width: 25%;{r}
    .body .columns td.four,
    .body .column td.four{l} width: 33.333333%;{r}
    .body .columns td.five,
    .body .column td.five{l} width: 41.666666%;{r}
    .body .columns td.six,
    .body .column td.six{l} width: 50%;{r}
    .body .columns td.seven,
    .body .column td.seven{l} width: 58.333333%;{r}
    .body .columns td.eight,
    .body .column td.eight{l} width: 66.666666%;{r}
    .body .columns td.nine,
    .body .column td.nine{l} width: 75%;{r}
    .body .columns td.ten,
    .body .column td.ten{l} width: 83.333333%;{r}
    .body .columns td.eleven,
    .body .column td.eleven{l} width: 91.666666%;{r}
    .body .columns td.twelve,
    .body .column td.twelve{l} width: 100%;{r}

    td.offset-by-one{l} padding-left: 50px;{r}
    td.offset-by-two{l} padding-left: 100px;{r}
    td.offset-by-three{l} padding-left: 150px;{r}
    td.offset-by-four{l} padding-left: 200px;{r}
    td.offset-by-five{l} padding-left: 250px;{r}
    td.offset-by-six{l} padding-left: 300px;{r}
    td.offset-by-seven{l} padding-left: 350px;{r}
    td.offset-by-eight{l} padding-left: 400px;{r}
    td.offset-by-nine{l} padding-left: 450px;{r}
    td.offset-by-ten{l} padding-left: 500px;{r}
    td.offset-by-eleven{l} padding-left: 550px;{r}

    td.expander{l}
    visibility: hidden;
    width: 0px;
    padding: 0 !important;
    {r}

    table.columns .text-pad,
    table.column .text-pad{l}
    padding-left: 10px;
    padding-right: 10px;
    {r}

    table.columns .left-text-pad,
    table.columns .text-pad-left,
    table.column .left-text-pad,
    table.column .text-pad-left{l}
    padding-left: 10px;
    {r}

    table.columns .right-text-pad,
    table.columns .text-pad-right,
    table.column .right-text-pad,
    table.column .text-pad-right{l}
    padding-right: 10px;
    {r}

    /* Block Grid */

    .block-grid{l}
    width: 100%;
    max-width: 500px;
    {r}

    .block-grid td{l}
    display: inline-block;
    padding:10px;
    {r}

    .two-up td{l}
    width:270px;
    {r}

    .three-up td{l}
    width:173px;
    {r}

    .four-up td{l}
    width:125px;
    {r}

    .five-up td{l}
    width:96px;
    {r}

    .six-up td{l}
    width:76px;
    {r}

    .seven-up td{l}
    width:62px;
    {r}

    .eight-up td{l}
    width:52px;
    {r}

    /* Alignment & Visibility Classes */

    table.center, td.center{l}
    text-align: center;
    {r}

    h1.center,
    h2.center,
    h3.center,
    h4.center,
    h5.center,
    h6.center{l}
    text-align: center;
    {r}

    span.center{l}
    display: block;
    width: 100%;
    text-align: center;
    {r}

    img.center{l}
    margin: 0 auto;
    float: none;
    {r}

    .show-for-small,
    .hide-for-desktop{l}
    display: none;
    {r}

    /* Typography */

    body, table.body, h1, h2, h3, h4, h5, h6, p, td{l}
    color: #{$sTextColor};
    font-family: "Helvetica", "Arial", sans-serif;
    font-weight: normal;
    padding:0;
    margin: 0;
    text-align: left;
    line-height: 1.3;
    {r}

    h1, h2, h3, h4, h5, h6{l}
    word-break: normal;
    {r}

    h1{l}font-size: 36px;}
    h2{l}font-size: 36px;}
    h3{l}font-size: 32px;}
    h4{l}font-size: 28px;}
    h5{l}font-size: 24px;}
    h6{l}font-size: 20px;}
    body, table.body, p, td{l}font-size: 14px;line-height:19px;}

    p.lead, p.lede, p.leed{l}
    font-size: 18px;
    line-height:21px;
    {r}

    small{l}
    font-size: 10px;
    {r}

    a{l}
    color: #{$sLinkColor};
    text-decoration: none;
    {r}

    a:hover{l}
    color: #2795b6 !important;
    {r}

    a:active{l}
    color: #2795b6 !important;
    {r}

    a:visited{l}
    color: #{$sLinkColor} !important;
    {r}

    h1 a,
    h2 a,
    h3 a,
    h4 a,
    h5 a,
    h6 a{l}
    color: #{$sLinkColor};
    {r}

    h1 a:active,
    h2 a:active,
    h3 a:active,
    h4 a:active,
    h5 a:active,
    h6 a:active{l}
    color: #{$sLinkColor} !important;
    {r}

    h1 a:visited,
    h2 a:visited,
    h3 a:visited,
    h4 a:visited,
    h5 a:visited,
    h6 a:visited{l}
    color: #{$sLinkColor} !important;
    {r}

    /* Panels */

    .panel{l}
    background: #f2f2f2;
    border: 1px solid #d9d9d9;
    padding: 10px !important;
    {r}

    .sub-grid table{l}
    width: 100%;
    {r}

    .sub-grid td.sub-columns{l}
    padding-bottom: 0;
    {r}

    /* Buttons */

    table.button,
    table.tiny-button,
    table.small-button,
    table.medium-button,
    table.large-button{l}
    width: 100%;
    overflow: hidden;
    {r}

    table.button td,
    table.tiny-button td,
    table.small-button td,
    table.medium-button td,
    table.large-button td{l}
    display: block;
    width: auto !important;
    text-align: center;
    background: #{$sLinkColor};
    border: 1px solid #2284a1;
    color: #ffffff;
    padding: 8px 0;
    {r}

    table.tiny-button td{l}
    padding: 5px 0 4px;
    {r}

    table.small-button td{l}
    padding: 8px 0 7px;
    {r}

    table.medium-button td{l}
    padding: 12px 0 10px;
    {r}

    table.large-button td{l}
    padding: 21px 0 18px;
    {r}

    table.button td a,
    table.tiny-button td a,
    table.small-button td a,
    table.medium-button td a,
    table.large-button td a{l}
    font-weight: bold;
    text-decoration: none;
    font-family: Helvetica, Arial, sans-serif;
    color: #ffffff;
    font-size: 16px;
    {r}

    table.tiny-button td a{l}
    font-size: 12px;
    font-weight: normal;
    {r}

    table.small-button td a{l}
    font-size: 16px;
    {r}

    table.medium-button td a{l}
    font-size: 20px;
    {r}

    table.large-button td a{l}
    font-size: 24px;
    {r}

    table.button:hover td,
    table.button:visited td,
    table.button:active td{l}
    background: #2795b6 !important;
    {r}

    table.button:hover td a,
    table.button:visited td a,
    table.button:active td a{l}
    color: #fff !important;
    {r}

    table.button:hover td,
    table.tiny-button:hover td,
    table.small-button:hover td,
    table.medium-button:hover td,
    table.large-button:hover td{l}
    background: #2795b6 !important;
    {r}

    table.button:hover td a,
    table.button:active td a,
    table.button td a:visited,
    table.tiny-button:hover td a,
    table.tiny-button:active td a,
    table.tiny-button td a:visited,
    table.small-button:hover td a,
    table.small-button:active td a,
    table.small-button td a:visited,
    table.medium-button:hover td a,
    table.medium-button:active td a,
    table.medium-button td a:visited,
    table.large-button:hover td a,
    table.large-button:active td a,
    table.large-button td a:visited{l}
    color: #ffffff !important;
    {r}

    table.secondary td{l}
    background: #e9e9e9;
    border-color: #d0d0d0;
    color: #555;
    {r}

    table.secondary td a{l}
    color: #555;
    {r}

    table.secondary:hover td{l}
    background: #d0d0d0 !important;
    color: #555;
    {r}

    table.secondary:hover td a,
    table.secondary td a:visited,
    table.secondary:active td a{l}
    color: #555 !important;
    {r}

    table.success td{l}
    background: #5da423;
    border-color: #457a1a;
    {r}

    table.success:hover td{l}
    background: #457a1a !important;
    {r}

    table.alert td{l}
    background: #c60f13;
    border-color: #970b0e;
    {r}

    table.alert:hover td{l}
    background: #970b0e !important;
    {r}

    table.radius td{l}
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    {r}

    table.round td{l}
    -webkit-border-radius: 500px;
    -moz-border-radius: 500px;
    border-radius: 500px;
    {r}

    /* Outlook First */

    body.outlook p{l}
    display: inline !important;
    {r}

    /*  Media Queries */

    @media only screen and (max-width: 600px){l}

    table[class="body"] img{l}
    width: auto !important;
    height: auto !important;
    {r}

    table[class="body"] center{l}
    min-width: 0 !important;
    {r}

    table[class="body"] .container{l}
    width: 95% !important;
    {r}

    table[class="body"] .row{l}
    width: 100% !important;
    display: block !important;
    {r}

    table[class="body"] .wrapper{l}
    display: block !important;
    padding-right: 0 !important;
    {r}

    table[class="body"] .columns,
    table[class="body"] .column{l}
    table-layout: fixed !important;
    float: none !important;
    width: 100% !important;
    padding-right: 0px !important;
    padding-left: 0px !important;
    display: block !important;
    {r}

    table[class="body"] .wrapper.first .columns,
    table[class="body"] .wrapper.first .column{l}
    display: table !important;
    {r}

    table[class="body"] table.columns td,
    table[class="body"] table.column td{l}
    width: 100% !important;
    {r}

    table[class="body"] .columns td.one,
    table[class="body"] .column td.one{l} width: 8.333333% !important;{r}
    table[class="body"] .columns td.two,
    table[class="body"] .column td.two{l} width: 16.666666% !important;{r}
    table[class="body"] .columns td.three,
    table[class="body"] .column td.three{l} width: 25% !important;{r}
    table[class="body"] .columns td.four,
    table[class="body"] .column td.four{l} width: 33.333333% !important;{r}
    table[class="body"] .columns td.five,
    table[class="body"] .column td.five{l} width: 41.666666% !important;{r}
    table[class="body"] .columns td.six,
    table[class="body"] .column td.six{l} width: 50% !important;{r}
    table[class="body"] .columns td.seven,
    table[class="body"] .column td.seven{l} width: 58.333333% !important;{r}
    table[class="body"] .columns td.eight,
    table[class="body"] .column td.eight{l} width: 66.666666% !important;{r}
    table[class="body"] .columns td.nine,
    table[class="body"] .column td.nine{l} width: 75% !important;{r}
    table[class="body"] .columns td.ten,
    table[class="body"] .column td.ten{l} width: 83.333333% !important;{r}
    table[class="body"] .columns td.eleven,
    table[class="body"] .column td.eleven{l} width: 91.666666% !important;{r}
    table[class="body"] .columns td.twelve,
    table[class="body"] .column td.twelve{l} width: 100% !important;{r}

    table[class="body"] td.offset-by-one,
    table[class="body"] td.offset-by-two,
    table[class="body"] td.offset-by-three,
    table[class="body"] td.offset-by-four,
    table[class="body"] td.offset-by-five,
    table[class="body"] td.offset-by-six,
    table[class="body"] td.offset-by-seven,
    table[class="body"] td.offset-by-eight,
    table[class="body"] td.offset-by-nine,
    table[class="body"] td.offset-by-ten,
    table[class="body"] td.offset-by-eleven{l}
    padding-left: 0 !important;
    {r}

    table[class="body"] table.columns td.expander{l}
    width: 1px !important;
    {r}

    table[class="body"] .right-text-pad,
    table[class="body"] .text-pad-right{l}
    padding-left: 10px !important;
    {r}

    table[class="body"] .left-text-pad,
    table[class="body"] .text-pad-left{l}
    padding-right: 10px !important;
    {r}

    table[class="body"] .hide-for-small,
    table[class="body"] .show-for-desktop{l}
    display: none !important;
    {r}

    table[class="body"] .show-for-small,
    table[class="body"] .hide-for-desktop{l}
    display: inherit !important;
    {r}
    {r}

  </style>
  <style>

    table.facebook td{l}
    background: #3b5998;
    border-color: #2d4473;
    {r}

    table.facebook:hover td{l}
    background: #2d4473 !important;
    {r}

    table.twitter td{l}
    background: #00acee;
    border-color: #0087bb;
    {r}

    table.twitter:hover td{l}
    background: #0087bb !important;
    {r}

    table.google-plus td{l}
    background-color: #DB4A39;
    border-color: #CC0000;
    {r}

    table.google-plus:hover td{l}
    background: #CC0000 !important;
    {r}

    .template-label{l}
    color: #ffffff;
    font-weight: bold;
    font-size: 20px;
    {r}

    .callout .panel{l}
    background: #ECF8FF;
    border-color: #b9e5ff;
    {r}

    .header{l}
    background: #{$sPagebg};
    {r}

    .footer .wrapper{l}
    background: #ebebeb;
    {r}

    .footer h5{l}
    padding-bottom: 10px;
    {r}

    table.columns .text-pad{l}
    padding-left: 10px;
    padding-right: 10px;
    {r}

    table.columns .left-text-pad{l}
    padding-left: 10px;
    {r}

    table.columns .right-text-pad{l}
    padding-right: 10px;
    {r}

    @media only screen and (max-width: 600px){l}

    table[class="body"] .right-text-pad{l}
    padding-left: 10px !important;
    {r}

    table[class="body"] .left-text-pad{l}
    padding-right: 10px !important;
    {r}
    {r}

  </style>
</head>
<body style="min-width: 100%;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;margin: 0;padding: 0;color: #{$sTextColor};font-family: &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif;font-weight: normal;text-align: left;line-height: 19px;font-size: 14px;width: 100% !important;">
  <table class="body" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;height: 100%;width: 100%;color: #{$sTextColor};font-family: &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;">
    <tr style="padding: 0;vertical-align: top;text-align: left;">
      <td class="center" align="center" valign="top" style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;padding: 0;vertical-align: top;text-align: center;color: #{$sTextColor};font-family: &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;border-collapse: collapse !important;">
        <center style="width: 100%;min-width: 500px;">

          <table class="row header" style="border-spacing: 0;border-collapse: collapse;padding: 0px;vertical-align: top;text-align: left;background: #{$sPagebg};width: 100%;position: relative;">
            <tr style="padding: 0;vertical-align: top;text-align: left;">
              <td class="center" align="center" style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;padding: 0;vertical-align: top;text-align: center;color: #{$sTextColor};font-family: &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;border-collapse: collapse !important;">
                <center style="width: 100%;min-width: 500px;">

                  <table class="container" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: inherit;width: 500px;margin: 0 auto;">
                    <tr style="padding: 0;vertical-align: top;text-align: left;">
                      <td class="wrapper last" style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;padding: 10px 20px 0px 0px;vertical-align: top;text-align: left;color: #{$sTextColor};font-family: &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;position: relative;padding-right: 0px;border-collapse: collapse !important;">
						{if $aDvs.branding_file_name}
                		<a href="{$sVideoLink}" style="color: #{$sLinkColor};text-decoration: none;">
                		{img path='core.url_file' file='dvs/branding/'.$aDvs.branding_file_name style="vertical-align:middle" max_width=600 max_height=300 suffix='_600'}</a>
                		{else}
                		<h2 style="color: #{$sTextColor};font-family: &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 1.3;word-break: normal;font-size: 36px;">{$aDvs.dealer_name} Virtual Test Drive for {$sShareName}</h2>
                		{/if}
                      </td>
                    </tr>
                  </table>

                </center>
              </td>
            </tr>
          </table>

          <br>

          <table class="container" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: inherit;width: 500px;margin: 0 auto;">
            <tr style="padding: 0;vertical-align: top;text-align: left;">
              <td style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;padding: 0;vertical-align: top;text-align: left;color: #{$sTextColor};font-family: &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;border-collapse: collapse !important;">

              <!-- content start -->
              <table class="row" style="border-spacing: 0;border-collapse: collapse;padding: 0px;vertical-align: top;text-align: left;width: 100%;position: relative;display: block;">
                <tr style="padding: 0;vertical-align: top;text-align: left;">
                  <td class="wrapper last" style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;padding: 10px 20px 0px 0px;vertical-align: top;text-align: left;color: #{$sTextColor};font-family: &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;position: relative;padding-right: 0px;border-collapse: collapse !important;">

                    <table class="twelve columns" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;margin: 0 auto;width: 500px;">
                      <tr style="padding: 0;vertical-align: top;text-align: left;">
                        <td style="text-align: center;word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;padding: 0px 0px 10px;vertical-align: top;color: #{$sTextColor};font-family: &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;border-collapse: collapse !important;">
                          <h6 style="padding-bottom: 10px!important;text-align: center;color: #{$sTextColor};font-family: &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif;font-weight: normal;padding: 0;margin: 0;line-height: 1.3;word-break: normal;font-size: 20px;"><a href="{$sVideoLink}" style="color: #{$sLinkColor};text-decoration: none;">{$aVideo.year} {$aVideo.make} {$aVideo.model} Virtual Test Drive</a>
                          <a href="{$sVideoLink}" style="color: #{$sLinkColor};text-decoration: none;">
                          {img server_id=$aVideo.image_server_id path='brightcove.url_image' file=$aVideo.image_path suffix='_email_500' title=$aVideo.name style='border:1px solid #$sLinkColor;'}
                          </a>
                        </h6></td>
                        <td class="expander" style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;padding: 0 !important;vertical-align: top;text-align: left;color: #{$sTextColor};font-family: &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;visibility: hidden;width: 0px;border-collapse: collapse !important;"></td>
                      </tr>
                    </table>

                    <table class="twelve columns" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;margin: 0 auto;width: 500px;">
                      <tr style="padding: 0;vertical-align: top;text-align: left;">
                        <td style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;padding: 0px 0px 10px;vertical-align: top;text-align: left;color: #{$sTextColor};font-family: &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;border-collapse: collapse !important;">
                          <table class="large-button" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;width: 100%;overflow: hidden;">
                            <tr style="padding: 0;vertical-align: top;text-align: left;">
                              <td style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;padding: 21px 0 18px;vertical-align: top;text-align: center;color: #{$sPagebg};font-family: &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;display: block;background: #{$sButtonBackground};border: 1px solid #{$sButtonText};border-collapse: collapse !important;width: auto !important;">
                                <a href="{$sVideoLink}" style="color: #{$sButtonText};text-decoration: none;font-weight: bold;font-family: Helvetica, Arial, sans-serif;font-size: 24px;">Take Your Virtual Test Drive</a>
                              </td>
                            </tr>
                          </table>
                        </td>
                        <td class="expander" style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;padding: 0 !important;vertical-align: top;text-align: left;color: #{$sTextColor};font-family: &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;visibility: hidden;width: 0px;border-collapse: collapse !important;"></td>
                      </tr>
                      {if $sShareMessage}
                      <tr style="padding: 0;vertical-align: top;text-align: left;">
                        <td class="panel" style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;padding: 10px !important;vertical-align: top;text-align: left;color: #{$sTextColor};font-family: &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;background: #f2f2f2;border: 1px solid #d9d9d9;border-collapse: collapse !important;">
                        <p style="font-size: 16px;margin: 0;color: #000000;font-family: &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif;font-weight: normal;padding: 0;text-align: left;line-height: 19px;">{$sShareMessage}</p>
                        </td>
                        <td class="expander" style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;padding: 0 !important;vertical-align: top;text-align: left;color: #{$sTextColor};font-family: &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;visibility: hidden;width: 0px;border-collapse: collapse !important;"></td>
                      </tr>
                      {/if}
                    </table>
                  </td>
                </tr>
              </table>
              <br>  <!-- Break Tag for row -->
              <table class="row" style="border-spacing: 0;border-collapse: collapse;padding: 0px;vertical-align: top;text-align: left;width: 100%;position: relative;display: block;">
                <tr style="padding: 0;vertical-align: top;text-align: left;">
                  <td class="twelve last" style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;padding: 0;vertical-align: top;text-align: left;color: #{$sTextColor};font-family: &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;padding-right: 0px;border-collapse: collapse !important;">
                    <table class="twelve columns" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;margin: 0 auto;width: 500px;">
                      <tr style="padding: 0;vertical-align: top;text-align: left;">
                        <td class="panel" style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;padding: 10px !important;vertical-align: top;text-align: left;color: #{$sTextColor};font-family: &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;background: #f2f2f2;border: 1px solid #d9d9d9;border-collapse: collapse !important;">
                          <h4 style="margin-bottom: 10px!important;color: #000;font-family: &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 1.3;word-break: normal;font-size: 28px;">Contact {$sMyShareName}</h4>
                          <h6 style="color: #000;font-family: &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 1.3;word-break: normal;font-size: 20px;">Email: <a href="mailto:{$sMyShareEmail}" style="color: #{$sLinkColor};text-decoration: none;">{$sMyShareEmail}</a></h6>
                          <h6 style="color: #000;font-family: &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif;font-weight: normal;padding: 0;margin: 0;text-align: left;line-height: 1.3;word-break: normal;font-size: 20px;">Phone: <a href="tel:{$sMySharePhone}" style="color: #{$sLinkColor};text-decoration: none;">{$sMySharePhone}</a></h6>
                        </td>
                        <td class="expander" style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;padding: 0 !important;vertical-align: top;text-align: left;color: #{$sTextColor};font-family: &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;visibility: hidden;width: 0px;border-collapse: collapse !important;"></td>
                      </tr>
                    </table>

                  </td>
                </tr>
              </table>
              <br>
              <!-- Legal + Unsubscribe -->
              <table class="row" style="border-spacing: 0;border-collapse: collapse;padding: 0px;vertical-align: top;text-align: left;width: 100%;position: relative;display: block;">
                <tr style="padding: 0;vertical-align: top;text-align: left;">
                  <td class="wrapper last" style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;padding: 10px 20px 0px 0px;vertical-align: top;text-align: left;color: #{$sTextColor};font-family: &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;position: relative;padding-right: 0px;border-collapse: collapse !important;">

                    <table class="twelve columns" style="border-spacing: 0;border-collapse: collapse;padding: 0;vertical-align: top;text-align: left;margin: 0 auto;width: 500px;">
                      <tr style="padding: 0;vertical-align: top;text-align: left;">
                        <td align="center" style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;padding: 0px 0px 10px;vertical-align: top;text-align: left;color: #{$sTextColor};font-family: &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;border-collapse: collapse !important;">
                          <center style="width: 100%;min-width: 500px;">
                            <p style="text-align: center;font-size: 10px;margin: 0;color: #{$sTextColor};font-family: &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif;font-weight: normal;padding: 0;line-height: 19px;"><a href="http://www.dealervideoshowroom.com" style="color: #{$sLinkColor};text-decoration: none;">Powered by Dealer Video Showroom</a></p>
                          </center>
                        </td>
                        <td class="expander" style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;padding: 0 !important;vertical-align: top;text-align: left;color: #{$sTextColor};font-family: &quot;Helvetica&quot;, &quot;Arial&quot;, sans-serif;font-weight: normal;margin: 0;line-height: 19px;font-size: 14px;visibility: hidden;width: 0px;border-collapse: collapse !important;"></td>
                      </tr>
                    </table>

                  </td>
                </tr>
              </table>

              <!-- container end below -->
              </td>
            </tr>
          </table>

        </center>
      </td>
    </tr>
  </table>
</body>
</html>
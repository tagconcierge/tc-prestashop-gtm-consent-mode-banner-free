<style data-tag-concierge-gtm-consent-mode-banner-styles>
    .consent-banner-button {
        text-decoration: none;
        background: none;
        color: #333333;
        padding: 4px 10px;
        border: 1px solid #000;
        text-wrap: nowrap;
        white-space: nowrap;
    }

    #consent-banner-main {
        position: relative;
        z-index: 2147483647;
    }
    /*
    #consent-banner-main,
    #consent-banner-wall,
    #consent-banner-modal {
      z-index: 99999;
    }*/


    #consent-banner-modal {
        background: #fff;
        padding: 25px 10px 30px !important;
        box-shadow: rgba(0, 0, 0, 0.4) 0 0 20px;
    }

    #consent-banner-modal .consent-banner-modal-wrapper {
        margin: 0 auto;
        justify-content: center;
        padding: 0 10px;
    }

    #consent-banner-settings h2 {
        padding-bottom: 15px;
        border-bottom: 1px solid #ededed;
    }

    #consent-banner-modal .consent-banner-modal-wrapper p {
        margin-bottom: 0;
    }

    #consent-banner-modal .consent-banner-modal-buttons {
        margin-top: 12px;
        text-align: center;
        justify-content: center;
    }

    /*#consent-banner-modal .consent-banner-modal-buttons [href="#accept"] {
      color: rgb(255, 255, 255);
      border: 1px solid #083b99;
      background-color: #083b99;
    } */

    #consent-banner-modal .consent-banner-modal-buttons [href="#settings"] {
        margin-left: 10px;
    }

    #consent-banner-settings .consent-banner-settings-buttons {
        margin-top: 15px;
        text-align: right;
    }

    #consent-banner-modal .consent-banner-modal-buttons .consent-banner-button {
        margin-left: 10px;
    }

    /*#consent-banner-settings .consent-banner-settings-buttons [href="#save"] {
      color: rgb(255, 255, 255);
      border: 1px solid #083b99;
      background-color: #083b99;
    } */

    #consent-banner-settings .consent-banner-settings-buttons [href="#close"] {
        margin-left: 10px;
    }

    #consent-banner-settings {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #fff;
        box-shadow: rgba(0, 0, 0, 0.4) 0 0 20px;
        padding: 20px 30px 15px;
        overflow-x: hidden;
        max-height: 80%;
        min-width: 500px;
    }

    #consent-banner-settings ul {
        list-style: none;
        padding-left: 0;
    }

    #consent-banner-settings ul label {
        font-weight: bold;
        font-size: 1.1em;
        margin-left: 5px;
    }

    #consent-banner-settings ul li {
        border-bottom: 1px solid rgba(0, 0, 0, .2);
        margin-bottom: 15px;
    }

    #consent-banner-settings ul p {
        margin-left: 25px;
    }


    /* customisation */
    .consent-banner-button:hover {
        color: rgba(231, 78, 30, .85);
        border-color: rgba(231, 78, 30, .85);
    }

    #consent-banner-settings .consent-banner-settings-buttons {
        text-align: center;
        display: flex;
        justify-content: space-around;
        grid-gap: 5px;
    }

    #consent-banner-settings .consent-banner-settings-buttons .consent-banner-button {
        flex: 1;
    }

    #consent-banner-main h2 {
        font-size: 18px;
        font-weight: bold;
    }

    #consent-banner-modal .consent-banner-modal-wrapper {
        display: flex;
    }

    #consent-banner-settings,
    #consent-banner-modal {
        border-radius: 6px;
    }

    .consent-banner-button {
        color: rgb(231, 78, 30);
        border-color: rgb(231, 78, 30);
        background-color: transparent;
        border-width: 2px;
        padding: 8px 27px;
        border-radius: 3px;
    }

    .consent-banner-button[href="#accept"] {
        color: #ffffff;
        border-color: rgb(231, 78, 30);
        background-color: rgb(231, 78, 30);
    }

    .consent-banner-button[href="#accept"]:hover {
        background-color: rgb(220, 114, 80);
        border-color: rgb(220, 114, 80);
    }

    #consent-banner-modal .consent-banner-modal-buttons {
        display: flex;
        align-items: flex-end;
    }

    #consent-banner-modal .consent-banner-modal-wrapper h2 {
        display: block !important;
    }

    /*#consent-banner-settings > div {
      position: relative;
    }*/

    /*#consent-banner-settings .consent-banner-settings-buttons {
      position: absolute;
    }*/

    #consent-banner-settings {
        max-height: none;
    }

    #consent-banner-settings > div > form div:nth-child(2) {
        /*  height: 600px;*/
        max-height: 65vh;
        overflow-x: hidden;
    }


    @media (max-width:576px) {

        #consent-banner-settings > div > form div:nth-child(2) {
            max-height: none;
        }

        #consent-banner-modal {
            width: auto;
            left: 5% !important;
            right: 5% !important;
            min-width: auto;
            transform: translate(0, -50%) !important;
        }

        #consent-banner-settings {
            width: auto;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            transform: none;
            max-height: 100%;
            min-width: auto;
        }

        #consent-banner-settings .consent-banner-settings-buttons {
            position: fixed;
            bottom: 0;
            right: 0;
            left: 0;
            background-color: #fff;
            padding-top: 16px;
            padding-bottom: 30px;
            padding-left: 50px;
            padding-right: 50px;
            text-align: center;
            display: block;
        }

        #consent-banner-settings .consent-banner-settings-buttons .button {
            width: 25%;
        }

        #consent-banner-modal .consent-banner-modal-buttons {
            margin: 0 !important;
        }

        #consent-banner-settings .consent-banner-settings-buttons .consent-banner-button {
            margin: 0;
            display: block;
            margin-bottom: 10px;
            text-align: center;
        }

        #consent-banner-settings ul {
            padding-bottom: 100px;
        }
    }

    @media (max-width:768px) {
        #consent-banner-modal .consent-banner-modal-wrapper p {
            margin-bottom: 10px;
        }

        #consent-banner-modal .consent-banner-modal-buttons {
            display: block;
        }

        #consent-banner-modal .consent-banner-modal-wrapper {
            display: block;
        }

        #consent-banner-modal .consent-banner-modal-buttons .consent-banner-button {
            margin: 0;
            display: block;
            margin-bottom: 10px;
            text-align: center;
        }
    }
</style>
<style data-tag-concierge-gtm-consent-mode-banner-styles>
    {$tc_gtmcb_custom_css nofilter}
</style>

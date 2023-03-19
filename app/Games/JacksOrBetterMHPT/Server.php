<?php 
namespace VanguardLTE\Games\JacksOrBetterMHPT
{
    include('CheckReels.php');
    class Server
    {
        public function get($request, $game)
        {/*
            if( config('LicenseDK.APL_INCLUDE_KEY_CONFIG') != 'wi9qydosuimsnls5zoe5q298evkhim0ughx1w16qybs2fhlcpn' ) 
            {
                return false;
            }
            if( md5_file(base_path() . '/config/LicenseDK.php') != '27f30d89977203af2f6822e48707425d' ) 
            {
                return false;
            }
            if( md5_file(base_path() . '/app/Lib/LicenseDK.php') != '22dde427cc10243ac0c7a3a625518e6f' ) 
            {
                return false;
            }
            $checked = new \VanguardLTE\Lib\LicenseDK();
            $license_notifications_array = $checked->aplVerifyLicenseDK(null, 0);
            if( $license_notifications_array['notification_case'] != 'notification_license_ok' ) 
            {
                $response = '{"responseEvent":"error","responseType":"error","serverResponse":"Error LicenseDK"}';
                exit( $response );
            } */
            \DB::beginTransaction();
            $userId = \Auth::id();
            if( $userId == null ) 
            {
                $response = '{"responseEvent":"error","responseType":"","serverResponse":"invalid login"}';
                exit( $response );
            }
            $slotSettings = new SlotSettings($game, $userId);
            $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22 = json_decode(trim(file_get_contents('php://input')), true);
            $_obf_0D1713290429323C0B2B02212E103E165B173416383632 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
            $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201 = [];
            if( isset($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['umid']) ) 
            {
                $umid = $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['umid'];
                if( isset($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['ID']) ) 
                {
                    $umid = $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['ID'];
                }
            }
            else
            {
                if( isset($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['ID']) ) 
                {
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"ID":18}';
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1713290429323C0B2B02212E103E165B173416383632 . ',"deltaBalanceInCents":1},"ID":40085}';
                }
                $umid = 0;
            }
            if( $umid == '40186' ) 
            {
                $cardsArr = [];
                for( $i = 0; $i <= 3; $i++ ) 
                {
                    for( $j = 0; $j <= 12; $j++ ) 
                    {
                        $cardsArr[] = (object)[
                            'suit' => '' . $i, 
                            'value' => '' . $j
                        ];
                    }
                }
                if( $slotSettings->GetGameData('JacksOrBetterMHPTDAmount') < 1 ) 
                {
                    $slotSettings->SetGameData('JacksOrBetterMHPTTotalWin', $slotSettings->GetGameData('JacksOrBetterMHPTTotalWin') / 2);
                }
                $_obf_0D37111B3335140203262E17350902171D182F5B312522 = $slotSettings->GetGameData('JacksOrBetterMHPTTotalWin');
                $_obf_0D2D5C32081D283D2E2B1921310518080E060604063032 = $_obf_0D37111B3335140203262E17350902171D182F5B312522 * 2;
                $slotSettings->SetBalance(-1 * $_obf_0D37111B3335140203262E17350902171D182F5B312522);
                $slotSettings->SetBank((isset($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']) ? $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] : ''), $_obf_0D37111B3335140203262E17350902171D182F5B312522);
                shuffle($cardsArr);
                $_obf_0D161A0D1C0B19143C31341F5C163E5B0415320E290A01 = [
                    $cardsArr[0], 
                    $cardsArr[1], 
                    $cardsArr[2], 
                    $cardsArr[3], 
                    $cardsArr[4]
                ];
                $_obf_0D2A341F1D5C1F3C13073C5C293B3B35043317400E1E22 = rand(1, 2);
                if( $_obf_0D2A341F1D5C1F3C13073C5C293B3B35043317400E1E22 == 1 ) 
                {
                    $_obf_0D1F3122335C1704150C39392E1827342A251B093D3732 = rand($slotSettings->GetGameData('JacksOrBetterMHPTDCard'), 12);
                }
                else
                {
                    $_obf_0D1F3122335C1704150C39392E1827342A251B093D3732 = rand(0, $slotSettings->GetGameData('JacksOrBetterMHPTDCard'));
                }
                $_obf_0D161A0D1C0B19143C31341F5C163E5B0415320E290A01 = [
                    $cardsArr[0], 
                    $cardsArr[1], 
                    $cardsArr[2], 
                    $cardsArr[3], 
                    $cardsArr[4]
                ];
                $_obf_0D161A0D1C0B19143C31341F5C163E5B0415320E290A01[(int)$_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['index'] - 1] = [
                    'value' => $_obf_0D1F3122335C1704150C39392E1827342A251B093D3732 . '', 
                    'suit' => rand(0, 3) . ''
                ];
                if( $slotSettings->GetGameData('JacksOrBetterMHPTDCard') == $_obf_0D1F3122335C1704150C39392E1827342A251B093D3732 ) 
                {
                    $totalWin = $_obf_0D37111B3335140203262E17350902171D182F5B312522;
                }
                else if( $slotSettings->GetGameData('JacksOrBetterMHPTDCard') < $_obf_0D1F3122335C1704150C39392E1827342A251B093D3732 ) 
                {
                    $totalWin = $_obf_0D2D5C32081D283D2E2B1921310518080E060604063032;
                }
                else
                {
                    $totalWin = 0;
                }
                $slotSettings->SetGameData('JacksOrBetterMHPTTotalWin', $totalWin);
                if( $totalWin > 0 ) 
                {
                    $slotSettings->SetBalance($totalWin);
                    $slotSettings->SetBank((isset($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']) ? $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] : ''), -1 * $totalWin);
                }
                $_obf_0D1713290429323C0B2B02212E103E165B173416383632 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"amount":' . $slotSettings->GetGameData('JacksOrBetterMHPTDAmount') . ',"cWin":' . $_obf_0D37111B3335140203262E17350902171D182F5B312522 . ',"pcard":' . $slotSettings->GetGameData('JacksOrBetterMHPTDCard') . ',"totalWin":' . $totalWin . ',"data":{"cards":' . json_encode($_obf_0D161A0D1C0B19143C31341F5C163E5B0415320E290A01) . ',"windowId":"VRqbhm"},"ID":40187,"umid":46}';
                $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1713290429323C0B2B02212E103E165B173416383632 . ',"deltaBalanceInCents":1},"ID":40085}';
                if( $totalWin <= 0 ) 
                {
                    $totalWin = -1 * $_obf_0D37111B3335140203262E17350902171D182F5B312522;
                }
                $response = '{"totalWin":' . $totalWin . ',"data":{"cards":' . json_encode($_obf_0D161A0D1C0B19143C31341F5C163E5B0415320E290A01) . ',"windowId":"VRqbhm"},"ID":40187,"umid":46}';
                $slotSettings->SaveLogReport($response, $slotSettings->GetGameData('JacksOrBetterMHPTBet'), 1, $totalWin, 'double');
            }
            if( $umid == '40182' ) 
            {
                $cardsArr = [];
                for( $i = 0; $i <= 3; $i++ ) 
                {
                    for( $j = 0; $j <= 12; $j++ ) 
                    {
                        $cardsArr[] = (object)[
                            'suit' => '' . $i, 
                            'value' => '' . $j
                        ];
                    }
                }
                shuffle($cardsArr);
                $slotSettings->SetGameData('JacksOrBetterMHPTDCard', (int)$cardsArr[0]->value);
                $slotSettings->SetGameData('JacksOrBetterMHPTDAmount', (double)$_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['amount']);
                $_obf_0D1713290429323C0B2B02212E103E165B173416383632 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"data":{"am":' . $slotSettings->GetGameData('JacksOrBetterMHPTDAmount') . ',"card":{"suit":"' . $cardsArr[0]->suit . '","value":"' . $cardsArr[0]->value . '"},"windowId":"VRqbhm"},"ID":40183,"umid":46}';
                $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1713290429323C0B2B02212E103E165B173416383632 . ',"deltaBalanceInCents":1},"ID":40085}';
            }
            if( $umid == '40179' ) 
            {
                $_obf_0D161A0D1C0B19143C31341F5C163E5B0415320E290A01 = $slotSettings->GetGameData('JacksOrBetterMHPTCurrentCards');
                $cardsArr = $slotSettings->GetGameData('JacksOrBetterMHPTCards');
                $_obf_0D0421331D082B13400825132F2C0C0326212537284011 = $slotSettings->GetGameData('JacksOrBetterMHPTBankReserved');
                $slotSettings->SetBank((isset($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']) ? $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] : ''), $_obf_0D0421331D082B13400825132F2C0C0326212537284011);
                $slotSettings->SetGameData('JacksOrBetterMHPTBankReserved', 0);
                $cardsArr = array_splice($cardsArr, 5);
                $_obf_0D104035221D280F101E5C2E31392B1D19082E06381132 = $slotSettings->GetGameData($slotSettings->slotId . 'Hands');
                $bank = $slotSettings->GetBank((isset($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']) ? $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] : ''));
                for( $i = 0; $i <= 2000; $i++ ) 
                {
                    $_obf_0D161A0D1C0B19143C31341F5C163E5B0415320E290A01 = $slotSettings->GetGameData('JacksOrBetterMHPTCurrentCards');
                    $_obf_0D32161F19383C282C03253B3C1D052D0C2F235B141F01 = [];
                    $totalWin = 0;
                    $_obf_0D03092D231325032215111B0E1A2F02130A1D08110B22 = [];
                    for( $_obf_0D401E1E131E112535250B3719143E1940152302091122 = 0; $_obf_0D401E1E131E112535250B3719143E1940152302091122 < $_obf_0D104035221D280F101E5C2E31392B1D19082E06381132; $_obf_0D401E1E131E112535250B3719143E1940152302091122++ ) 
                    {
                        shuffle($cardsArr);
                        $_obf_0D0B2C1A1303340B2C0E25400D1E23015C0637363D2411 = 0;
                        for( $j = 0; $j < 5; $j++ ) 
                        {
                            if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['cardHolds'][$j] == 0 ) 
                            {
                                $_obf_0D161A0D1C0B19143C31341F5C163E5B0415320E290A01[$i] = $cardsArr[$_obf_0D0B2C1A1303340B2C0E25400D1E23015C0637363D2411];
                                $_obf_0D0B2C1A1303340B2C0E25400D1E23015C0637363D2411++;
                            }
                        }
                        $_obf_0D144030072C09300C13273D0B122A320C3B04012D0B32 = $slotSettings->GetCombination([
                            $_obf_0D161A0D1C0B19143C31341F5C163E5B0415320E290A01[0]->value, 
                            $_obf_0D161A0D1C0B19143C31341F5C163E5B0415320E290A01[1]->value, 
                            $_obf_0D161A0D1C0B19143C31341F5C163E5B0415320E290A01[2]->value, 
                            $_obf_0D161A0D1C0B19143C31341F5C163E5B0415320E290A01[3]->value, 
                            $_obf_0D161A0D1C0B19143C31341F5C163E5B0415320E290A01[4]->value
                        ], [
                            $_obf_0D161A0D1C0B19143C31341F5C163E5B0415320E290A01[0]->suit, 
                            $_obf_0D161A0D1C0B19143C31341F5C163E5B0415320E290A01[1]->suit, 
                            $_obf_0D161A0D1C0B19143C31341F5C163E5B0415320E290A01[2]->suit, 
                            $_obf_0D161A0D1C0B19143C31341F5C163E5B0415320E290A01[3]->suit, 
                            $_obf_0D161A0D1C0B19143C31341F5C163E5B0415320E290A01[4]->suit
                        ]);
                        $_obf_0D32161F19383C282C03253B3C1D052D0C2F235B141F01[] = '{"cards":' . json_encode($_obf_0D161A0D1C0B19143C31341F5C163E5B0415320E290A01) . '}';
                        $totalWin += (($_obf_0D144030072C09300C13273D0B122A320C3B04012D0B32 * $slotSettings->GetGameData('JacksOrBetterMHPTBet')) / $_obf_0D104035221D280F101E5C2E31392B1D19082E06381132);
                        $_obf_0D03092D231325032215111B0E1A2F02130A1D08110B22[] = ($_obf_0D144030072C09300C13273D0B122A320C3B04012D0B32 * $slotSettings->GetGameData('JacksOrBetterMHPTBet')) / $_obf_0D104035221D280F101E5C2E31392B1D19082E06381132;
                    }
                    if( $totalWin <= $bank ) 
                    {
                        break;
                    }
                }
                if( $totalWin > 0 ) 
                {
                    $slotSettings->SetBalance($totalWin);
                    $slotSettings->SetBank((isset($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']) ? $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] : ''), -1 * $totalWin);
                }
                $slotSettings->SetGameData('JacksOrBetterMHPTTotalWin', $totalWin);
                $_obf_0D1713290429323C0B2B02212E103E165B173416383632 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"tw":[' . implode(',', $_obf_0D03092D231325032215111B0E1A2F02130A1D08110B22) . '],"totalWin":' . $totalWin . ',"data":{"cards":[' . implode(',', $_obf_0D32161F19383C282C03253B3C1D052D0C2F235B141F01) . '],"windowId":"OxupG1"},"ID":40180,"umid":53}';
                $response = '{"responseEvent":"spin","responseType":"bet","serverResponse":{"Hands":' . $slotSettings->GetGameData($slotSettings->slotId . 'Hands') . ',"cardsArr":' . json_encode($cardsArr) . ',"state":"idle","slotLines":1,"slotBet":' . $slotSettings->GetGameData('JacksOrBetterMHPTBet') . ',"totalFreeGames":0,"currentFreeGames":0,"Balance":' . $_obf_0D1713290429323C0B2B02212E103E165B173416383632 . ',"afterBalance":' . $_obf_0D1713290429323C0B2B02212E103E165B173416383632 . ',"bonusWin":0,"totalWin":' . $totalWin . ',"winLines":[],"cards":' . json_encode($_obf_0D161A0D1C0B19143C31341F5C163E5B0415320E290A01) . '}}';
                $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1713290429323C0B2B02212E103E165B173416383632 . ',"deltaBalanceInCents":1},"ID":40085}';
                $slotSettings->SaveLogReport($response, 0, 1, $totalWin, 'bet');
            }
            if( $umid == '40175' ) 
            {
                $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['bet'] = $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['bet'] / 100;
                $allbet = $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['bet'];
                if( $slotSettings->GetBalance() < $allbet ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $umid . '","serverResponse":"invalid balance"}';
                    return $response;
                }
                if( $allbet < 0.0001 ) 
                {
                    $response = '{"responseEvent":"error","responseType":"' . $umid . '","serverResponse":"invalid bet"}';
                    return $response;
                }
                if( !isset($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']) ) 
                {
                    $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] = 'bet';
                }
                $_obf_0D2A0526273612293511363C26193E1C130B2719192611 = $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['bet'] / 100 * $slotSettings->GetPercent();
                $slotSettings->SetBank((isset($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']) ? $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] : ''), $_obf_0D2A0526273612293511363C26193E1C130B2719192611, $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']);
                $slotSettings->UpdateJackpots($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['bet']);
                $slotSettings->SetBalance(-1 * $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['bet'], $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']);
                $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201 = [];
                $cardsArr = [];
                for( $i = 0; $i <= 3; $i++ ) 
                {
                    for( $j = 0; $j <= 12; $j++ ) 
                    {
                        $cardsArr[] = (object)[
                            'suit' => '' . $i, 
                            'value' => '' . $j
                        ];
                    }
                }
                $bank = $slotSettings->GetBank((isset($_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent']) ? $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['slotEvent'] : ''));
                for( $i = 0; $i <= 2000; $i++ ) 
                {
                    shuffle($cardsArr);
                    $_obf_0D161A0D1C0B19143C31341F5C163E5B0415320E290A01 = [
                        $cardsArr[0], 
                        $cardsArr[1], 
                        $cardsArr[2], 
                        $cardsArr[3], 
                        $cardsArr[4]
                    ];
                    $_obf_0D144030072C09300C13273D0B122A320C3B04012D0B32 = $slotSettings->GetCombination([
                        $_obf_0D161A0D1C0B19143C31341F5C163E5B0415320E290A01[0]->value, 
                        $_obf_0D161A0D1C0B19143C31341F5C163E5B0415320E290A01[1]->value, 
                        $_obf_0D161A0D1C0B19143C31341F5C163E5B0415320E290A01[2]->value, 
                        $_obf_0D161A0D1C0B19143C31341F5C163E5B0415320E290A01[3]->value, 
                        $_obf_0D161A0D1C0B19143C31341F5C163E5B0415320E290A01[4]->value
                    ], [
                        $_obf_0D161A0D1C0B19143C31341F5C163E5B0415320E290A01[0]->suit, 
                        $_obf_0D161A0D1C0B19143C31341F5C163E5B0415320E290A01[1]->suit, 
                        $_obf_0D161A0D1C0B19143C31341F5C163E5B0415320E290A01[2]->suit, 
                        $_obf_0D161A0D1C0B19143C31341F5C163E5B0415320E290A01[3]->suit, 
                        $_obf_0D161A0D1C0B19143C31341F5C163E5B0415320E290A01[4]->suit
                    ]);
                    $totalWin = $_obf_0D144030072C09300C13273D0B122A320C3B04012D0B32 * $allbet;
                    if( $totalWin <= $bank ) 
                    {
                        $slotSettings->SetGameData('JacksOrBetterMHPTBankReserved', $totalWin);
                        break;
                    }
                }
                $_obf_0D161A0D1C0B19143C31341F5C163E5B0415320E290A01 = [
                    $cardsArr[0], 
                    $cardsArr[1], 
                    $cardsArr[2], 
                    $cardsArr[3], 
                    $cardsArr[4]
                ];
                $slotSettings->SetGameData('JacksOrBetterMHPTBet', $allbet);
                $slotSettings->SetGameData('JacksOrBetterMHPTCurrentCards', $_obf_0D161A0D1C0B19143C31341F5C163E5B0415320E290A01);
                $slotSettings->SetGameData('JacksOrBetterMHPTCards', $cardsArr);
                $_obf_0D1713290429323C0B2B02212E103E165B173416383632 = sprintf('%01.2f', $slotSettings->GetBalance()) * 100;
                $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"data":{"credit":' . $_obf_0D1713290429323C0B2B02212E103E165B173416383632 . ',"cards":' . json_encode($_obf_0D161A0D1C0B19143C31341F5C163E5B0415320E290A01) . ',"windowId":"OxupG1"},"ID":40176,"umid":53}';
                $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1713290429323C0B2B02212E103E165B173416383632 . ',"deltaBalanceInCents":1},"ID":40085}';
                $response = '{"responseEvent":"spin","responseType":"bet","serverResponse":{"Hands":' . $slotSettings->GetGameData($slotSettings->slotId . 'Hands') . ',"cardsArr":' . json_encode($cardsArr) . ',"state":"draw","slotLines":1,"slotBet":' . $allbet . ',"totalFreeGames":0,"currentFreeGames":0,"Balance":' . $_obf_0D1713290429323C0B2B02212E103E165B173416383632 . ',"afterBalance":' . $_obf_0D1713290429323C0B2B02212E103E165B173416383632 . ',"bonusWin":0,"totalWin":' . $totalWin . ',"winLines":[],"cards":' . json_encode($_obf_0D161A0D1C0B19143C31341F5C163E5B0415320E290A01) . '}}';
                $slotSettings->SaveLogReport($response, $allbet, 1, 0, 'bet');
            }
            switch( $umid ) 
            {
                case '40384':
                    if( $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['handsCount'] > 0 && $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['handsCount'] <= 50 ) 
                    {
                        $_obf_0D131333153E3B3F113536290D1D1A025B0D3F16341932 = $slotSettings->Bet;
                        for( $i = 0; $i < count($_obf_0D131333153E3B3F113536290D1D1A025B0D3F16341932); $i++ ) 
                        {
                            $_obf_0D131333153E3B3F113536290D1D1A025B0D3F16341932[$i] = $_obf_0D131333153E3B3F113536290D1D1A025B0D3F16341932[$i] * 100;
                        }
                        $slotSettings->SetGameData($slotSettings->slotId . 'Hands', $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['handsCount']);
                        $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"data":{"handCount":' . $_obf_0D1027172F0A071202030538280B3D0B12241B16110E22['handsCount'] . ',"optionEnabledHands":[1,50,4,100,25,10],"showLimitsInClient":true,"disableHalfDoubleMode":true,"gameLimits":{"gameGroup":"jb_mh1","minBet":0,"maxBet":0,"minPosBet":0,"maxPosBet":50000,"coinSizes":[' . implode(',', $_obf_0D131333153E3B3F113536290D1D1A025B0D3F16341932) . ']},"doubleBetMultiplier":0,"windowId":"28ysnC"},"ID":40385,"umid":31}';
                    }
                    break;
                case '31031':
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"data":{"urlList":[{"urlType":"mobile_login","url":"https://login.loc/register","priority":1},{"urlType":"mobile_support","url":"https://ww2.loc/support","priority":1},{"urlType":"playerprofile","url":"","priority":1},{"urlType":"playerprofile","url":"","priority":10},{"urlType":"gambling_commission","url":"","priority":1},{"urlType":"cashier","url":"","priority":1},{"urlType":"cashier","url":"","priority":1}]},"ID":100}';
                    break;
                case '10001':
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"data":{"typeBalance":2,"balanceInCents":0},"ID":40083,"umid":3}';
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1713290429323C0B2B02212E103E165B173416383632 . ',"deltaBalanceInCents":0},"ID":40083,"umid":4}';
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"data":{"commandId":13218,"params":["0","null"]},"ID":50001,"umid":5}';
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"token":{"secretKey":"","currency":"USD","balance":0,"loginTime":""},"ID":10002,"umid":7}';
                    break;
                case '40294':
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"nicknameInfo":{"nickname":""},"ID":10022,"umid":8}';
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"data":{"commandId":10713,"params":["0","ba","bj","ct","gc","grel","hb","jb_mh","ro","sc","tr"]},"ID":50001,"umid":9}';
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"data":{"commandId":11666,"params":["0","0","0"]},"ID":50001,"umid":11}';
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"data":{"commandId":13981,"params":["0","1"]},"ID":50001,"umid":12}';
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"data":{"commandId":14080,"params":["0","0"]},"ID":50001,"umid":14}';
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"data":{"keyValueCount":5,"elementsPerKey":1,"params":["10","1","11","500","12","1","13","0","14","0"]},"ID":40716,"umid":15}';
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1713290429323C0B2B02212E103E165B173416383632 . ',"deltaBalanceInCents":0},"ID":40083,"umid":16}';
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"balanceInfo":{"clientType":"casino","totalBalance":' . $_obf_0D1713290429323C0B2B02212E103E165B173416383632 . ',"currency":"' . $slotSettings->slotCurrency . '","balanceChange":' . $_obf_0D1713290429323C0B2B02212E103E165B173416383632 . '},"ID":10006,"umid":17}';
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"data":{},"ID":40292,"umid":18}';
                    break;
                case '10010':
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"data":{"urls":{"casino-cashier-myaccount":[],"regulation_pt_self_exclusion":[],"link_legal_aams":[],"regulation_pt_player_protection":[],"mobile_cashier":[],"mobile_bank":[],"mobile_bonus_terms":[],"mobile_help":[],"link_responsible":[],"cashier":[{"url":"","priority":1},{"url":"","priority":1}],"gambling_commission":[{"url":"","priority":1},{"url":"","priority":1}],"desktop_help":[],"chat_token":[],"mobile_login_error":[],"mobile_error":[],"mobile_login":[{"url":"","priority":1}],"playerprofile":[{"url":"","priority":1},{"url":"","priority":10}],"link_legal_half":[],"ngmdesktop_quick_deposit":[],"external_login_form":[],"mobile_main_promotions":[],"mobile_lobby":[],"mobile_promotion":[],{"url":"","priority":1},{"url":"","priority":10}],"mobile_withdraw":[],"mobile_funds_trans":[],"mobile_quick_deposit":[],"mobile_history":[],"mobile_deposit_limit":[],"minigames_help":[],"link_legal_18":[],"mobile_responsible":[],"mobile_share":[],"mobile_lobby_error":[],"mobile_mobile_comp_points":[],"mobile_support":[{"url":"","priority":1}],"mobile_chat":[],"mobile_logout":[],"mobile_deposit":[],"invite_friend":[]}},"ID":10011,"umid":19}';
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"data":{"brokenGames":[],"windowId":"SuJLru"},"ID":40037,"umid":20}';
                    break;
                case '40024':
                    $_obf_0D131333153E3B3F113536290D1D1A025B0D3F16341932 = $slotSettings->Bet;
                    for( $i = 0; $i < count($_obf_0D131333153E3B3F113536290D1D1A025B0D3F16341932); $i++ ) 
                    {
                        $_obf_0D131333153E3B3F113536290D1D1A025B0D3F16341932[$i] = $_obf_0D131333153E3B3F113536290D1D1A025B0D3F16341932[$i] * 100;
                    }
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"data":{"funNoticeGames":0,"funNoticePayouts":0,"gameGroup":"jb_mh","minBet":0,"maxBet":0,"minPosBet":0,"maxPosBet":50000,"coinSizes":[' . implode(',', $_obf_0D131333153E3B3F113536290D1D1A025B0D3F16341932) . ']},"ID":40025,"umid":19}';
                    break;
                case '40036':
                    $slotSettings->SetGameData($slotSettings->slotId . 'BonusWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeGames', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'CurrentFreeGame', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'TotalWin', 0);
                    $slotSettings->SetGameData($slotSettings->slotId . 'FreeBalance', 0);
                    $slotSettings->SetGameData('JacksOrBetterMHPTBets', []);
                    $lastEvent = $slotSettings->GetHistory();
                    $slotSettings->SetGameData($slotSettings->slotId . 'brokenGames', '');
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"data":{"brokenGames":["' . $slotSettings->GetGameData($slotSettings->slotId . 'brokenGames') . '"],"windowId":"SuJLru"},"ID":40037,"umid":22}';
                    break;
                case '40020':
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"data":{"typeBalance":2,"balanceInCents":0},"ID":40085}';
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"data":{"typeBalance":1,"balanceInCents":0},"ID":40085}';
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1713290429323C0B2B02212E103E165B173416383632 . ',"deltaBalanceInCents":0},"ID":40085}';
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"data":{"credit":' . $_obf_0D1713290429323C0B2B02212E103E165B173416383632 . ',"windowId":"SuJLru"},"ID":40026,"umid":28}';
                    break;
                case '40050':
                    $lastEvent = $slotSettings->GetHistory();
                    if( $lastEvent != 'NULL' && $lastEvent->serverResponse->state == 'draw' ) 
                    {
                        $slotSettings->SetGameData($slotSettings->slotId . 'Cards', $lastEvent->serverResponse->cardsArr);
                        $slotSettings->SetGameData($slotSettings->slotId . 'CurrentCards', $lastEvent->serverResponse->cards);
                        $slotSettings->SetGameData($slotSettings->slotId . 'Bet', $lastEvent->serverResponse->slotBet);
                        $slotSettings->SetGameData($slotSettings->slotId . 'Hands', $lastEvent->serverResponse->Hands);
                        $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"data":{},"ID":40031,"umid":18}';
                        $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"data":{"windowId":"ErbtIw"},"ID":48047,"umid":19}';
                        $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"data":{},"ID":40031,"umid":18}';
                        $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"data":{"bet":' . ($lastEvent->serverResponse->slotBet * 100) . ',"numCoins":1,"isDouble":false,"cards":' . json_encode($lastEvent->serverResponse->cards) . ',"handCount":' . $lastEvent->serverResponse->Hands . ',"windowId":"K0QpQs"},"ID":40387,"umid":28}';
                    }
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"data":{"typeBalance":2,"balanceInCents":0},"ID":40085}';
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"data":{"typeBalance":1,"balanceInCents":0},"ID":40085}';
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"data":{"typeBalance":0,"currency":"' . $slotSettings->slotCurrency . '","balanceInCents":' . $_obf_0D1713290429323C0B2B02212E103E165B173416383632 . ',"deltaBalanceInCents":0},"ID":40085}';
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"data":{"credit":' . $_obf_0D1713290429323C0B2B02212E103E165B173416383632 . ',"windowId":"SuJLru"},"ID":40026,"umid":28}';
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"data":{"limitType":[1,2,3,4],"limitMin":[100,100,100,100],"limitMax":[1000,10000,8000,50000],"windowId":"MVRRkz"},"ID":40008,"umid":29}';
                    break;
                case '48300':
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"balanceInfo":{"clientType":"casino","totalBalance":' . $_obf_0D1713290429323C0B2B02212E103E165B173416383632 . ',"currency":"' . $slotSettings->slotCurrency . '","balanceChange":0},"ID":10006,"umid":30}';
                    $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201[] = '3:::{"data":{"waitingLogins":[],"waitingAlerts":[],"waitingDialogs":[],"waitingDialogMessages":[],"waitingToasterMessages":[]},"ID":48301,"umid":31}';
                    break;
            }
            $response = implode('------', $_obf_0D15240C2724212608283D0C5B1E141D0230162D100201);
            $slotSettings->SaveGameData();
            \DB::commit();
            return $response;
        }
    }

}

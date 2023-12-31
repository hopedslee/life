@echo off
rem mt1 -> mtx batch program

set mtpath=C:\Users\Administrator\AppData\Roaming\MetaQuotes\Terminal
set mt1=3934FE5152706E9B11F7A9C4B5DA1B1B

set ef=Reporter.mq4
set sf=AccountLog.ex4

set ep=MQL4\Experts
set sp=MQL4\Scripts

set expert=%ep%\%ef%
set script=%sp%\%sf%

set org_expert=%mtpath%\%mt1%\%expert%
set org_script=%mtpath%\%mt1%\%script%

rem mt1 -> mt2
set mtx=C900F4DD89EBD559B48737D81AC4BF91
set dest_expert=%mtpath%\%mtx%\%ep%
set dest_script=%mtpath%\%mtx%\%sp%
copy %org_expert% %dest_expert%
copy %org_script% %dest_script%

rem mt1 -> mt3
set mtx=61B1272CCDDE1FD79BC56F6F957528C1
set dest_expert=%mtpath%\%mtx%\%ep%
set dest_script=%mtpath%\%mtx%\%sp%
copy %org_expert% %dest_expert%
copy %org_script% %dest_script%

rem mt1 -> mt4
set mtx=FC651FF9170F91733ADCF33D2E0233BB
set dest_expert=%mtpath%\%mtx%\%ep%
set dest_script=%mtpath%\%mtx%\%sp%
copy %org_expert% %dest_expert%
copy %org_script% %dest_script%

rem mt1 -> mt5
set mtx=DB8C8502ED4E8E6C011C3B2C39ADBA53
set dest_expert=%mtpath%\%mtx%\%ep%
set dest_script=%mtpath%\%mtx%\%sp%
copy %org_expert% %dest_expert%
copy %org_script% %dest_script%

rem mt1 -> mt6
set mtx=8D6534A8E74BA2A3EB1FF575A69854FC
set dest_expert=%mtpath%\%mtx%\%ep%
set dest_script=%mtpath%\%mtx%\%sp%
copy %org_expert% %dest_expert%
copy %org_script% %dest_script%

rem mt1 -> mt7
set mtx=FB891377C5755F0ED005DD58729E768C
set dest_expert=%mtpath%\%mtx%\%ep%
set dest_script=%mtpath%\%mtx%\%sp%
copy %org_expert% %dest_expert%
copy %org_script% %dest_script%

rem mt1 -> mt8
set mtx=59444A20D0AE36E69E80789E23936932
set dest_expert=%mtpath%\%mtx%\%ep%
set dest_script=%mtpath%\%mtx%\%sp%
copy %org_expert% %dest_expert%
copy %org_script% %dest_script%

rem mt1 -> mt9
set mtx=ABA242EC9535C4B8162CF773E8553C87
set dest_expert=%mtpath%\%mtx%\%ep%
set dest_script=%mtpath%\%mtx%\%sp%
copy %org_expert% %dest_expert%
copy %org_script% %dest_script%

rem mt1 -> mt10
set mtx=5388CC881709F0612C923306850F03B1
set dest_expert=%mtpath%\%mtx%\%ep%
set dest_script=%mtpath%\%mtx%\%sp%
copy %org_expert% %dest_expert%
copy %org_script% %dest_script%

rem mt1 -> mt11
set mtx=15668762A4C6C1459265FA48621CCD88
set dest_expert=%mtpath%\%mtx%\%ep%
set dest_script=%mtpath%\%mtx%\%sp%
copy %org_expert% %dest_expert%
copy %org_script% %dest_script%

rem mt1 -> mt12
set mtx=CFF1CA1F2A91E8684C60E6A7B9505E77
set dest_expert=%mtpath%\%mtx%\%ep%
set dest_script=%mtpath%\%mtx%\%sp%
copy %org_expert% %dest_expert%
copy %org_script% %dest_script%

rem mt1 -> mt13
set mtx=3BB38C115408B3AED2214F131A8DFB5F
set dest_expert=%mtpath%\%mtx%\%ep%
set dest_script=%mtpath%\%mtx%\%sp%
copy %org_expert% %dest_expert%
copy %org_script% %dest_script%

rem mt1 -> mt14
set mtx=9D2122583B86F451D72D4BC1F0FE6DAA
set dest_expert=%mtpath%\%mtx%\%ep%
set dest_script=%mtpath%\%mtx%\%sp%
copy %org_expert% %dest_expert%
copy %org_script% %dest_script%

rem mt1 -> mt15
set mtx=2C27B14E67C1952D414FF940CDE0C75C
set dest_expert=%mtpath%\%mtx%\%ep%
set dest_script=%mtpath%\%mtx%\%sp%
copy %org_expert% %dest_expert%
copy %org_script% %dest_script%

set expert=MQL4\Experts
set script=MQL4\Scripts
REM Experts folder
set f1="MACD Sample.mq4"
set f2="MACD Sample.ex4"
set f3="Moving Average.mq4"
set f4="Moving Average.ex4"
REM Scripts folder
set f5=PeriodConverter.mq4
set f6=PeriodConverter.ex4
set f7=Examples
set f8=AccountLog.ex4

FOR %%G IN (
3934FE5152706E9B11F7A9C4B5DA1B1B,
C900F4DD89EBD559B48737D81AC4BF91
61B1272CCDDE1FD79BC56F6F957528C1,
FC651FF9170F91733ADCF33D2E0233BB,
DB8C8502ED4E8E6C011C3B2C39ADBA53,
8D6534A8E74BA2A3EB1FF575A69854FC,
FB891377C5755F0ED005DD58729E768C,
59444A20D0AE36E69E80789E23936932,
ABA242EC9535C4B8162CF773E8553C87,
5388CC881709F0612C923306850F03B1,
15668762A4C6C1459265FA48621CCD88,
CFF1CA1F2A91E8684C60E6A7B9505E77,
3BB38C115408B3AED2214F131A8DFB5F,
9D2122583B86F451D72D4BC1F0FE6DAA,
2C27B14E67C1952D414FF940CDE0C75C
) DO (DEL %mtpath%\%%G\%expert%\%f1%)

FOR %%G IN (
3934FE5152706E9B11F7A9C4B5DA1B1B,
C900F4DD89EBD559B48737D81AC4BF91
61B1272CCDDE1FD79BC56F6F957528C1,
FC651FF9170F91733ADCF33D2E0233BB,
DB8C8502ED4E8E6C011C3B2C39ADBA53,
8D6534A8E74BA2A3EB1FF575A69854FC,
FB891377C5755F0ED005DD58729E768C,
59444A20D0AE36E69E80789E23936932,
ABA242EC9535C4B8162CF773E8553C87,
5388CC881709F0612C923306850F03B1,
15668762A4C6C1459265FA48621CCD88,
CFF1CA1F2A91E8684C60E6A7B9505E77,
3BB38C115408B3AED2214F131A8DFB5F,
9D2122583B86F451D72D4BC1F0FE6DAA,
2C27B14E67C1952D414FF940CDE0C75C
) DO (DEL %mtpath%\%%G\%expert%\%f2%)

FOR %%G IN (
3934FE5152706E9B11F7A9C4B5DA1B1B,
C900F4DD89EBD559B48737D81AC4BF91
61B1272CCDDE1FD79BC56F6F957528C1,
FC651FF9170F91733ADCF33D2E0233BB,
DB8C8502ED4E8E6C011C3B2C39ADBA53,
8D6534A8E74BA2A3EB1FF575A69854FC,
FB891377C5755F0ED005DD58729E768C,
59444A20D0AE36E69E80789E23936932,
ABA242EC9535C4B8162CF773E8553C87,
5388CC881709F0612C923306850F03B1,
15668762A4C6C1459265FA48621CCD88,
CFF1CA1F2A91E8684C60E6A7B9505E77,
3BB38C115408B3AED2214F131A8DFB5F,
9D2122583B86F451D72D4BC1F0FE6DAA,
2C27B14E67C1952D414FF940CDE0C75C
) DO (DEL %mtpath%\%%G\%expert%\%f3%)

FOR %%G IN (
3934FE5152706E9B11F7A9C4B5DA1B1B,
C900F4DD89EBD559B48737D81AC4BF91
61B1272CCDDE1FD79BC56F6F957528C1,
FC651FF9170F91733ADCF33D2E0233BB,
DB8C8502ED4E8E6C011C3B2C39ADBA53,
8D6534A8E74BA2A3EB1FF575A69854FC,
FB891377C5755F0ED005DD58729E768C,
59444A20D0AE36E69E80789E23936932,
ABA242EC9535C4B8162CF773E8553C87,
5388CC881709F0612C923306850F03B1,
15668762A4C6C1459265FA48621CCD88,
CFF1CA1F2A91E8684C60E6A7B9505E77,
3BB38C115408B3AED2214F131A8DFB5F,
9D2122583B86F451D72D4BC1F0FE6DAA,
2C27B14E67C1952D414FF940CDE0C75C
) DO (DEL %mtpath%\%%G\%expert%\%f4%)

FOR %%G IN (
3934FE5152706E9B11F7A9C4B5DA1B1B,
C900F4DD89EBD559B48737D81AC4BF91
61B1272CCDDE1FD79BC56F6F957528C1,
FC651FF9170F91733ADCF33D2E0233BB,
DB8C8502ED4E8E6C011C3B2C39ADBA53,
8D6534A8E74BA2A3EB1FF575A69854FC,
FB891377C5755F0ED005DD58729E768C,
59444A20D0AE36E69E80789E23936932,
ABA242EC9535C4B8162CF773E8553C87,
5388CC881709F0612C923306850F03B1,
15668762A4C6C1459265FA48621CCD88,
CFF1CA1F2A91E8684C60E6A7B9505E77,
3BB38C115408B3AED2214F131A8DFB5F,
9D2122583B86F451D72D4BC1F0FE6DAA,
2C27B14E67C1952D414FF940CDE0C75C
) DO (DEL %mtpath%\%%G\%script%\%f5%)

FOR %%G IN (
3934FE5152706E9B11F7A9C4B5DA1B1B,
C900F4DD89EBD559B48737D81AC4BF91
61B1272CCDDE1FD79BC56F6F957528C1,
FC651FF9170F91733ADCF33D2E0233BB,
DB8C8502ED4E8E6C011C3B2C39ADBA53,
8D6534A8E74BA2A3EB1FF575A69854FC,
FB891377C5755F0ED005DD58729E768C,
59444A20D0AE36E69E80789E23936932,
ABA242EC9535C4B8162CF773E8553C87,
5388CC881709F0612C923306850F03B1,
15668762A4C6C1459265FA48621CCD88,
CFF1CA1F2A91E8684C60E6A7B9505E77,
3BB38C115408B3AED2214F131A8DFB5F,
9D2122583B86F451D72D4BC1F0FE6DAA,
2C27B14E67C1952D414FF940CDE0C75C
) DO (DEL %mtpath%\%%G\%script%\%f6%)

FOR %%G IN (
3934FE5152706E9B11F7A9C4B5DA1B1B,
C900F4DD89EBD559B48737D81AC4BF91
61B1272CCDDE1FD79BC56F6F957528C1,
FC651FF9170F91733ADCF33D2E0233BB,
DB8C8502ED4E8E6C011C3B2C39ADBA53,
8D6534A8E74BA2A3EB1FF575A69854FC,
FB891377C5755F0ED005DD58729E768C,
59444A20D0AE36E69E80789E23936932,
ABA242EC9535C4B8162CF773E8553C87,
5388CC881709F0612C923306850F03B1,
15668762A4C6C1459265FA48621CCD88,
CFF1CA1F2A91E8684C60E6A7B9505E77,
3BB38C115408B3AED2214F131A8DFB5F,
9D2122583B86F451D72D4BC1F0FE6DAA,
2C27B14E67C1952D414FF940CDE0C75C
) DO (RMDIR /S /Q %mtpath%\%%G\%script%\%f7%)

FOR %%G IN (
3934FE5152706E9B11F7A9C4B5DA1B1B,
C900F4DD89EBD559B48737D81AC4BF91
61B1272CCDDE1FD79BC56F6F957528C1,
FC651FF9170F91733ADCF33D2E0233BB,
DB8C8502ED4E8E6C011C3B2C39ADBA53,
8D6534A8E74BA2A3EB1FF575A69854FC,
FB891377C5755F0ED005DD58729E768C,
59444A20D0AE36E69E80789E23936932,
ABA242EC9535C4B8162CF773E8553C87,
5388CC881709F0612C923306850F03B1,
15668762A4C6C1459265FA48621CCD88,
CFF1CA1F2A91E8684C60E6A7B9505E77,
3BB38C115408B3AED2214F131A8DFB5F,
9D2122583B86F451D72D4BC1F0FE6DAA,
2C27B14E67C1952D414FF940CDE0C75C
) DO (DEL %mtpath%\%%G\%script%\%f8%)

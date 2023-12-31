//+------------------------------------------------------------------+
//| Minero 2019.05.29-1
//| Copyright 2019, DSRobotec
//| http://dsrobotec.iptime.org
//+------------------------------------------------------------------+
#import "kernel32.dll"
int GetComputerNameW(short &lpBuffer[], int &nSize[]);
#import

#define     propLink        "https://dsrobotec.kr"
#define     propVersion     "21.0629"
/*
 * 2021.06.29 Forex Trader Copier 2 ON/OFF Check
 */
#define     propDescription "Minero Reporter"
#define     propCopyright   "DSRobotec, Inc."

#property   link              propLink
#property   version           propVersion
#property   description       propDescription
#property   copyright         propCopyright
//#property   icon              propIcon
#property   strict

bool     check;

string   Font        = "Arial Bold";
color    FontColor   = clrYellow;
int      FontSize    = 14;
//+------------------------------------------------------------------+
//|                                                                  |
//+------------------------------------------------------------------+
bool        TickReceived=false;
//+------------------------------------------------------------------+
//|                                                                  |
//+------------------------------------------------------------------+
extern   int      TIMER=30;
extern   bool     UPDATOR_SHOW=FALSE;
extern   bool     DEBUG = FALSE;
string TerminalID[];
datetime NextTime=0;
string domain1="dsrobotec.iptime.org";
string heartbeat="fx/heartbeat.php";
string acctlog="fx/updator/acctlog.php";
string update_history="fx/updator/update_history.php";

//+------------------------------------------------------------------+
//|                                                                  |
//+------------------------------------------------------------------+
int OnInit()
  {
   string tmp[];
   string tp=TerminalInfoString(TERMINAL_PATH);
   string sep="\\";
   ushort u_sep;
   u_sep=StringGetCharacter(sep,0);
   int k=StringSplit(tp,u_sep,tmp);
   sep="-";
   u_sep=StringGetCharacter(sep,0);

   k=StringSplit(tmp[2],u_sep, TerminalID);

   if(StringLen(TerminalID[1])<2)
      TerminalID[1]="0"+TerminalID[1];

   ushort buf[1024];
   int len [1];
   len[0] = 1024;
   string ComputerName = "";
//---
   GetComputerNameW(buf, len);
//---
   string cname=ShortArrayToString(buf);
   TerminalID[1]=cname+"-"+TerminalID[1];
   SetLabel("id",TerminalID[1],10,20,clrLimeGreen,FontSize);
   SetLabel("acno",IntegerToString(AccountNumber()),10,42,FontColor,FontSize);
   SetLabel("acname",AccountName(),10,64,FontColor,FontSize);
   SetLabel("time",TimeToString(TimeCurrent(),TIME_SECONDS)+" / "+ TimeToString(TimeCurrent(),TIME_DATE),10,86,FontColor,FontSize);

   EventSetTimer(TIMER);
   return(INIT_SUCCEEDED);
  }

string DepWitCheck()
{
   double deposit, withdrawal;
   string depwit = "";
   //int closed_orders=0;
   datetime today_midnight=TimeCurrent()-(TimeCurrent()%(PERIOD_D1*60));
   
   for(int c=OrdersHistoryTotal()-1; c>=0; c--)
   {
      check = OrderSelect(c,SELECT_BY_POS,MODE_HISTORY);
      if( (check == TRUE) && OrderCloseTime()>=today_midnight)
      {
         if(OrderType()>5)
         {
            string time=StringSubstr(TimeToString(OrderOpenTime(),TIME_DATE|TIME_MINUTES),5,11);
            if(OrderProfit()<0)
            {
               deposit=0;
               withdrawal=OrderProfit();
               if(depwit == "") 
                  depwit = StringFormat("%s(%s%s)",time,DoubleToString(withdrawal,2),"w");
               else 
                  depwit = StringFormat("%s / %s(%s%s)",depwit,time,DoubleToString(withdrawal,2),"w");
                  
            }
            else
            {
               deposit=OrderProfit();
               withdrawal=0;
               if(depwit == "")
                  depwit = StringFormat("%s(%s%s)",time,DoubleToString(deposit,2),"d");
               else 
                  depwit = StringFormat("%s / %s(%s%s)",depwit,time,DoubleToString(deposit,2),"d");                  
            }
         }              
      }
   }   
   return(depwit);
}    
  
//+------------------------------------------------------------------+
//|                                                                  |
//+------------------------------------------------------------------+
bool FlagOrderCheck( double &flagprice )
  {
   int total=OrdersTotal();
   int counts = 0;
   string os = "";
   bool result = FALSE;
      
   for(int c=0; c<total; c++)
   {
      check=OrderSelect(c,SELECT_BY_POS,MODE_TRADES);
      if(check == TRUE)
      {
         os = StringSubstr(OrderSymbol(),0,6);
         StringToLower(os);
         if( os == "gbpjpy" && OrderType()==OP_BUYLIMIT && (99.000 < OrderOpenPrice() && OrderOpenPrice()<110.000) ) 
         {
            flagprice = OrderOpenPrice();           
            result = TRUE;
         }
      }
   }
   return(result);
  }

//+------------------------------------------------------------------+
//|                                                                  |
//+------------------------------------------------------------------+

double FlagOrderprice = NormalizeDouble(100.000,3);
int magic = 87654321;

void PutOrder()
{
   string depwit = "";
   double flagprice = 0;
   int slippage = 20;
   bool FOC;
   int EXP_MIN = 180;   // flag order expire after 180min (3 hours)
   int hour = Hour();
   int min = Minute();
   if( (hour % 6) == 0 && min == 1 ) {
      FOC = FlagOrderCheck(flagprice);
      if(FOC == FALSE) {
         double lots = NormalizeDouble(0.01,2);
         string comments = "flag";
         datetime expire=TimeCurrent()+EXP_MIN*60;
         int ticket=OrderSend("GBPJPY",OP_BUYLIMIT,lots,FlagOrderprice,slippage,0,0,comments,magic,expire,clrNONE);
         if(ticket<0) printf("l=%d,ticket=%d,error=%d",__LINE__,ticket,GetLastError());
         else {
            printf("l=%d, Flag order not exists and new order sent ticket=%d",__LINE__,ticket);
            FOC = FlagOrderCheck(flagprice);
         }         
      }
   }
   return;
}
//+------------------------------------------------------------------+
//|                                                                  |
//+------------------------------------------------------------------+
void OnTick()
  {
   if(AccountNumber() == 633124) PutOrder();
   //if(AccountNumber() == 220038641) PutOrder();
   
   TickReceived=true;
   SetLabel("time",TimeToString(TimeCurrent(),TIME_SECONDS)+" / "+ TimeToString(TimeCurrent(),TIME_DATE),10,86,FontColor,FontSize);
   int ta=TerminalInfoInteger(TERMINAL_TRADE_ALLOWED);
   if(!ta)
     {
      SetLabel("ea","Experts are disabled!",14,102,clrRed,FontSize+4);
     }
   else
      ObjectDelete("ea");

  } // Main
//+------------------------------------------------------------------+
//|                                                                  |
//+------------------------------------------------------------------+
void OnTimer()
  {
   if(DEBUG)
   {
      string depwit = DepWitCheck();
      printf("l=%d, depwit=%s",__LINE__,depwit);
   }
   bool ic = false;
   ic = IsConnected();
   if(ic)
     {
      if(TerminalInfoInteger(TERMINAL_TRADE_ALLOWED))
        {
         if(DayOfWeek()==0 || DayOfWeek()==6)
           {
            updator();
           }
         else
           {
            if(TickReceived)
              {
               updator();
               update_dw();   // update deposit or withdrawal during all trade time
               TickReceived=false;
              }
           }
        }
     }
  }
//+------------------------------------------------------------------+
//|                                                                  |
//+------------------------------------------------------------------+
double servertime=Hour()+(Minute()*0.01);
//+------------------------------------------------------------------+
//|                                                                  |
//+------------------------------------------------------------------+
void updator()
  {
//----------------------------------------------------------------------
   string cookie=NULL,headers;
   char post[],result[];
   int ret;
   string url="";
   int timeout=5000;

   double lots=0;
   double deposit=0, withdrawal=0, profit=0;

   ResetLastError();

   int conn=TerminalInfoInteger(TERMINAL_CONNECTED);
   int ta=TerminalInfoInteger(TERMINAL_TRADE_ALLOWED);
   
   string depwit = "";
//printf("l=%d, connected=%d, tradeallowed=%d",__LINE__,conn,ta);

   if(ta)
     {
      // server 1
      double flagprice = 0;
      int cps = CPsTotal();
      bool FOC = FlagOrderCheck(flagprice);
      depwit = DepWitCheck();
      url=StringFormat(
             //"http://%s/%s?acno=%d&server='%s'&acname='%s'&balance=%.0f&equity=%.0f&ml=%.0f&orders=%d&CPs=%d&bl=%.2f&sl=%.2f&nl=%.2f&swap=%.2f&remark='%s'",
             "http://%s/%s?acno=%d&server='%s'&acname='%s'&balance=%.0f&equity=%.0f&ml=%.0f&orders=%d&CPs=%d&swap=%.2f&remark='%s'&flagprice=%.3f&depwit='%s'",
             domain1,heartbeat,AccountNumber(),AccountServer(),AccountName(),AccountBalance(),AccountEquity(),AccountInfoDouble(ACCOUNT_MARGIN_LEVEL),
             OrdersTotal(),cps,SwapTotal(),TerminalID[1],flagprice,depwit);
      ret=WebRequest("GET",url,cookie,NULL,timeout,post,0,result,headers);
      string msg=CharArrayToString(result,0);
      if(UPDATOR_SHOW)
        {
         printf("l=%d, msg=%s",__LINE__,msg);
         printf("l=%d, url=%s",__LINE__,url);
        }
     }

//+------------------------------------------------------------------+
//|                                                                  |
//+------------------------------------------------------------------+
   servertime=Hour()+(Minute()*0.01);
   string msg="";
//
// acctlog 테이블 갱신
//
   int dow = DayOfWeek();
   if(servertime>23.50 && servertime<23.59)
     {
      // update and/or insert equty data
      url=StringFormat("http://%s/%s?acno=%d&date=%s&balance=%.1f&profit=%.1f&swap=%.1f&margin=%.1f",
                       domain1,acctlog,AccountNumber(),TimeToString(TimeCurrent(),TIME_DATE),AccountBalance(),AccountProfit(),SwapTotal(),AccountMargin());
      //printf("l=%d, servertime=%.2f, url=%s",__LINE__,servertime,url);
      ret=WebRequest("GET",url,cookie,NULL,timeout,post,0,result,headers);
      msg=CharArrayToString(result,0);
      printf("l=%d, servertime=%.2f, url=%s, msg=%s",__LINE__, servertime, url, msg);
     }
   //else if( servertime>00.00 && servertime<00.59 )
   // 월요일(dow=1) 아침에는 전날밤(토요일밤) 데이터를 수집하지 않게...
   else
      if( (dow > 1) && servertime>00.00 && servertime<00.59)
        {
         url=StringFormat("http://%s/%s?acno=%d&date=%s&balance=%.1f&profit=%.1f&swap=%.1f&margin=%.1f",
                          domain1,acctlog,AccountNumber(),TimeToString(TimeCurrent()-60*60*24,TIME_DATE),AccountBalance(),AccountProfit(),SwapTotal(),AccountMargin());
         ret=WebRequest("GET",url,cookie,NULL,timeout,post,0,result,headers);
         msg=CharArrayToString(result,0);
         printf("l=%d, servertime=%.2f, url=%s, msg=%s",__LINE__, servertime, url, msg);
         /*
         url=StringFormat("http://%s/%s?acno=%d&date=%s&balance=%.1f&profit=%.1f&swap=%.1f&margin=%.1f",
                          domain2,acctlog,AccountNumber(),TimeToString(TimeCurrent()-60*60*24,TIME_DATE),AccountBalance(),AccountProfit(),SwapTotal(),AccountMargin());
         ret=WebRequest("GET",url,cookie,NULL,timeout,post,0,result,headers);
         msg=CharArrayToString(result,0);
         printf("l=%d, servertime=%.2f, url=%s, msg=%s",__LINE__, servertime, url, msg);
         */
        }
   //
   // OrdersHistory 테이블 갱신
   // 1 2  3 4  5
   // 월,화,수,목,금
   if( ( dow >0 ) && (servertime>23.50 && servertime<23.59))
     {
      // update and/or insert OrdersHistory
      int total=OrdersHistoryTotal();
      printf("l=%d, total=%d",__LINE__,total);
      for(int c=0; c<total; c++)
        {
         if(OrderSelect(c,SELECT_BY_POS,MODE_HISTORY))
           {
            string ordertype="";
            //printf("l=%d, Ticket=%d",__LINE__,OrderTicket());
            switch(OrderType())
              {
               case 0:
                  ordertype="buy";
                  break;
               case 1:
                  ordertype="sell";
                  break;
               case 2:
                  ordertype="buylimit";
                  break;
               case 3:
                  ordertype="selllimit";
                  break;
               case 4:
                  ordertype="buystop";
                  break;
               case 5:
                  ordertype="sellstop";
                  break;
               default:
                  break;
              }

            if(OrderType()>5)
              {
               lots=0;
               if(OrderProfit()<0)
                 {
                  deposit=0;
                  withdrawal=OrderProfit()*(-1);
                 }
               else
                 {
                  deposit=OrderProfit();
                  withdrawal=0;
                 }
               //printf("l=%d, ot=%d, withdrawal=%.1f",__LINE__,OrderType(),withdrawal);
               profit=0;
              }
            else
              {

               deposit=0;
               withdrawal=0;
               profit=OrderProfit();
               lots=OrderLots();
              }

            string message = StringFormat("%d^%d^%s^%s^%.2f^%s^%f^%f^%f^%s^%f^%.1f^%.1f^%.1f^%.1f^%.1f^%d^%s",
                                          AccountNumber(),   //0
                                          OrderTicket(),     //1
                                          OrderSymbol(),     //2
                                          ordertype,         //3
                                          lots,              //4

                                          TimeToStr(OrderOpenTime(),TIME_DATE|TIME_SECONDS),  //5
                                          OrderOpenPrice(),  //6
                                          OrderStopLoss(),   //7
                                          OrderTakeProfit(), //8
                                          TimeToStr(OrderCloseTime(),TIME_DATE|TIME_SECONDS), //9

                                          OrderClosePrice(), //10
                                          deposit,           //11
                                          withdrawal,        //12
                                          profit,            //13
                                          OrderSwap(),       //14

                                          OrderCommission(), //15
                                          OrderMagicNumber(),//16
                                          StringTrimRight(OrderComment())     //17
                                         );

            url=StringFormat("http://%s/%s?message=%s", domain1, update_history, message);
            ret=WebRequest("GET",url,cookie,NULL,timeout,post,0,result,headers);
            msg=CharArrayToString(result,0);
           } // order select
        } // for
     }
   return;
  }
//+------------------------------------------------------------------+
//|                                                                  |
//+------------------------------------------------------------------+
void update_dw()
{
   string cookie=NULL, headers;
   char post[],result[];
   string url="";
   int timeout=5000;
   int ret;

   double lots=0;
   double deposit=0, withdrawal=0, profit=0;
   string ordertype="";
   string message="";
   string msg="";
   
   int total=OrdersHistoryTotal();
   //printf("l=%d, total=%d",__LINE__,total);
   for(int c=0; c<total; c++)
   {
      check=OrderSelect(c,SELECT_BY_POS,MODE_HISTORY);
      if(check)
        {
         ordertype="";

         if(OrderType()>5)
           {
            lots=0;
            profit=0;
            if(OrderProfit()<0)
            {
               deposit=0;
               withdrawal=OrderProfit()*(-1);
            }
            else
            {
               deposit=OrderProfit();
               withdrawal=0;
            }
            
            //string message;
            
            message = StringFormat("%d^%d^%s^%s^%.2f^%s^%f^%f^%f^%s^%f^%.1f^%.1f^%.1f^%.1f^%.1f^%d^%s",
                                       AccountNumber(),   //0
                                       OrderTicket(),     //1
                                       OrderSymbol(),     //2
                                       ordertype,         //3
                                       lots,              //4

                                       TimeToStr(OrderOpenTime(),TIME_DATE|TIME_SECONDS),  //5
                                       OrderOpenPrice(),  //6
                                       OrderStopLoss(),   //7
                                       OrderTakeProfit(), //8
                                       TimeToStr(OrderCloseTime(),TIME_DATE|TIME_SECONDS), //9

                                       OrderClosePrice(), //10
                                       deposit,           //11
                                       withdrawal,        //12
                                       profit,            //13
                                       OrderSwap(),       //14

                                       OrderCommission(), //15
                                       OrderMagicNumber(),//16
                                       StringTrimRight(OrderComment())     //17
                                      );
                                   
               url=StringFormat("http://%s/%s?message=%s", domain1, update_history, message );
               ret=WebRequest("GET",url,cookie,NULL,timeout,post,0,result,headers);
               msg=CharArrayToString(result,0);
               if(StringTrimRight(msg) == "inserts")
               {
                  printf("l=%d, msg=%s",__LINE__, msg);
                  printf("l=%d, url=%s",__LINE__, url);
               }   
           } // if        
        } // order select
   } // for
   return;
}   
//+------------------------------------------------------------------+
//|                                                                  |
//+------------------------------------------------------------------+
void OnDeinit(int const reason)
  {
   ResetLastError();
   ObjectsDeleteAll();
   return;
  } // end of OnDeInit()
//+------------------------------------------------------------------+
//|                                                                  |
//+------------------------------------------------------------------+
double SwapTotal()
  {
   double swap=0;
   int total=OrdersTotal();
//---
   for(int c=0; c<total; c++)
     {
      check=OrderSelect(c,SELECT_BY_POS,MODE_TRADES);
      if(check)
        {
         swap+=OrderSwap();
        }
     } // for(int c = 0; c < total; c++)

   return(swap);
  }
//+------------------------------------------------------------------+
//|                                                                  |
//+------------------------------------------------------------------+
int CPsTotal()
  {
   string cp[];
   int Total_CPs=0;
   int total=OrdersTotal();
   int idx=0;

   ArrayResize(cp,total);

   for(int c=0; c<total; c++)
     {
      if(OrderSelect(c,SELECT_BY_POS,MODE_TRADES)==true)
        {
         if(c==0)
           {
            cp[idx++]=OrderSymbol();
           }

         int diff=0;
         for(int i=0; i<idx; i++)
           {
            if(OrderSymbol() == cp[i])
               break;
            else
               diff++;
           }

         if(diff == idx)
            cp[idx++] = OrderSymbol();
        }
      }
   Total_CPs=idx;
   return(Total_CPs);
  }
//+------------------------------------------------------------------+
//|                                                                  |
//+------------------------------------------------------------------+
void SetLabel(string name,string text,int x,int y,color clr,int fontsize=8,string fontname="Arial")
  {
   if(ObjectFind(0,name)<0)
     {
      if(!ObjectCreate(0,name,OBJ_LABEL,0,0,0))
        {
         printf("l=%d, error=%d, OBJ_LABEL %s :",__LINE__,GetLastError(),name);
         return;
        }
     }

   ObjectSetInteger(0,name,OBJPROP_FONTSIZE,fontsize);
   ObjectSetInteger(0,name,OBJPROP_XDISTANCE,x);
   ObjectSetInteger(0,name,OBJPROP_YDISTANCE,y);
   ObjectSetInteger(0,name,OBJPROP_SELECTABLE,FALSE);
   ObjectSetString(0,name,OBJPROP_TEXT,text);
   ObjectSetInteger(0,name,OBJPROP_CORNER,CORNER_RIGHT_UPPER);
   ObjectSetInteger(0,name,OBJPROP_ANCHOR,ANCHOR_RIGHT_UPPER);
   ObjectSetText(name,text,0,fontname,clr);
  }
//+------------------------------------------------------------------+
//|                                                                  |
//+------------------------------------------------------------------+

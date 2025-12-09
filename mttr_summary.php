

<?php 

      ////////////////////

      $MTTI_query = sqlsrv_query( $con ,"SELECT isnull ((

SELECT 

   cast(CAST(avg(CAST(([First_category]- [creation_time])AS FLOAT)) AS datetime) as time) [MTTI]

  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
  left join employee_web_table on username = MTTI2_eng
  where  employee_web_table.manager ='$self'
  and year(creation_time) = year(getdate()) and Fake_Real = 'Real Ticket' 
  and ( closure_reason <> 'Duplicated tickets' or closure_reason is null) 
  and  IIF(Resolve_time is null,Final_close,Resolve_time) is not null and ( Ticket_group <> 'unmanaged' or Ticket_group is null )
  and RequestID not in (SELECT distinct [RequestID]
  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
  where Category = 'Request' and Subcategory in ( 'MRTG' ,'Monitoring') and Item in ( 'Add graph',
'adjust graph',
'delete graph',
'adjust account',
'add circuit',
'adjust circuit',
'delete circuit') )),'00:00:00') [MTTI]");
            $get_MTTI= (sqlsrv_fetch_array($MTTI_query));
            $MTTI = $get_MTTI['MTTI']->format('H:i:s');

            /////////////
      $MTTR_query = sqlsrv_query( $con ,"SELECT isnull ((SELECT 
   
   cast(CAST(avg(CAST(( IIF(Resolve_time is null,Final_close,Resolve_time)- [creation_time])AS FLOAT)) AS datetime) as time) [MTTR]

  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
   left join employee_web_table on username = Last_engineer
  where employee_web_table.manager ='$self' and year(creation_time) = year(getdate()) and Fake_Real = 'Real Ticket' and ( closure_reason <> 'Duplicated tickets' or closure_reason is null) and 
  IIF(Resolve_time is null,Final_close,Resolve_time) is not null and ( Ticket_group <> 'unmanaged' or Ticket_group is null ) and RequestID not in (SELECT distinct [RequestID]

  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
  where Category = 'Request' and Subcategory in ( 'MRTG' ,'Monitoring') and Item in ( 'Add graph',
'adjust graph',
'delete graph',
'adjust account',
'add circuit',
'adjust circuit',
'delete circuit')) ),'00:00:00') [MTTR] ");
       $output_mttr = (sqlsrv_fetch_array($MTTR_query));
       $get_MTTR = $output_mttr['MTTR']->format('H:i:s');
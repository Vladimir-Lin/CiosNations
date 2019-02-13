<?php

//////////////////////////////////////////////////////////////////////////////

require_once dirname(__FILE__) . "/constants.php" ;
require_once dirname(__FILE__) . "/parameters.php" ;
require_once dirname(__FILE__) . "/actionsdb.php" ;

//////////////////////////////////////////////////////////////////////////////
// PHP NameItem Class

class NameItem {
//////////////////////////////////////////////////////////////////////////////

public $Id        ;
public $Uuid      ;
public $Locality  ;
public $Priority  ;
public $Relevance ;
public $Flags     ;
public $Length    ;
public $Name      ;
public $Columns   ;

//////////////////////////////////////////////////////////////////////////////

function __construct()
{
  $this -> clear ( )  ;
}

function __destruct()
{
  unset ( $this -> Columns ) ;
}

public function clear()
{
  $this -> Id        = 0         ;
  $this -> Uuid      = 0         ;
  $this -> Locality  = 0         ;
  $this -> Priority  = 0         ;
  $this -> Relevance = 0         ;
  $this -> Flags     = 0         ;
  $this -> Length    = 0         ;
  $this -> Name      = ""        ;
  $this -> Columns   = array ( ) ;
}

public function assign($Item)
{
  $this -> Id        = $Item -> Id        ;
  $this -> Uuid      = $Item -> Uuid      ;
  $this -> Locality  = $Item -> Locality  ;
  $this -> Priority  = $Item -> Priority  ;
  $this -> Relevance = $Item -> Relevance ;
  $this -> Flags     = $Item -> Flags     ;
  $this -> Length    = $Item -> Length    ;
  $this -> Name      = $Item -> Name      ;
}

public function tableItems()
{
  $S = array (                  ) ;
  array_push ( $S , "id"        ) ;
  array_push ( $S , "uuid"      ) ;
  array_push ( $S , "locality"  ) ;
  array_push ( $S , "priority"  ) ;
  array_push ( $S , "relevance" ) ;
  array_push ( $S , "flags"     ) ;
  array_push ( $S , "length"    ) ;
  array_push ( $S , "name"      ) ;
  return $S                       ;
}

public function JoinItems ( $X , $S = "," )
{
  $U = array ( )               ;
  foreach ( $X as $V )         {
    $W = "`" . $V . "`"        ;
    array_push ( $U , $W )     ;
  }                            ;
  $L = implode ( $S , $U )     ;
  unset ( $U )                 ;
  return $L                    ;
}

public function Items( $S = "," )
{
  $X = $this -> tableItems (         ) ;
  $L = $this -> JoinItems  ( $X , $S ) ;
  unset                    ( $X      ) ;
  return $L                            ;
}

public function ClearColumns()
{
  unset ( $this -> Columns )     ;
  $this -> Columns   = array ( ) ;
}

public function AddColumn ( $C )
{
  array_push ( $this -> Columns , $C ) ;
}

public function isFlag($Mask)
{
  return ( ( gmp_and ( $Mask , $this -> Flags ) ) == $Mask ) ;
}

public function isUuid($u)
{
  return ( 0 == gmp_cmp ( $u , $this -> Uuid ) ) ;
}

public function isLocality($L)
{
  return ( $L == $this -> Locality ) ;
}

public function isRelevance ($r)
{
  return ( $r == $this -> Relevance ) ;
}

public function hasName()
{
  return ( strlen ( $this -> Name ) > 0 ) ;
}

public function set($item,$V)
{
  $a = strtolower ( $item )                        ;
  if ( "id"        == $a ) $this -> Id        = $V ;
  if ( "uuid"      == $a ) $this -> Uuid      = $V ;
  if ( "locality"  == $a ) $this -> Locality  = $V ;
  if ( "priority"  == $a ) $this -> Priority  = $V ;
  if ( "relevance" == $a ) $this -> Relevance = $V ;
  if ( "flags"     == $a ) $this -> Flags     = $V ;
  if ( "length"    == $a ) $this -> Length    = $V ;
  if ( "name"      == $a ) $this -> Name      = $V ;
}

public function setRelevance($N)
{
  global $NameUsages                      ;
  $this -> Relevance = $NameUsages [ $N ] ;
}

public function OptionsTail($Options,$Limits)
{
  $Q = ""                        ;
  if ( strlen ( $Options ) > 0 ) {
    $Q .= " "                    ;
    $Q .= $Options               ;
  }                              ;
  if ( strlen ( $Limits  ) > 0 ) {
    $Q .= " "                    ;
    $Q .= $Limits                ;
  }                              ;
  return $Q                      ;
}

public function ItemPair($item)
{
  $a = strtolower ( $item )                                ;
  if ( "id"        == $a )                                 {
    return "`" . $a . "` = " . (string) $this -> Id        ;
  }                                                        ;
  if ( "uuid"      == $a )                                 {
    return "`" . $a . "` = " . (string) $this -> Uuid      ;
  }                                                        ;
  if ( "locality"  == $a )                                 {
    return "`" . $a . "` = " . (string) $this -> Locality  ;
  }                                                        ;
  if ( "priority"  == $a )                                 {
    return "`" . $a . "` = " . (string) $this -> Priority  ;
  }                                                        ;
  if ( "relevance" == $a )                                 {
    return "`" . $a . "` = " . (string) $this -> Relevance ;
  }                                                        ;
  if ( "flags"     == $a )                                 {
    return "`" . $a . "` = " . (string) $this -> Flags     ;
  }                                                        ;
  if ( "length"    == $a )                                 {
    return "`" . $a . "` = " . (string) $this -> Length    ;
  }                                                        ;
  if ( "name"      == $a )                                 {
    return "`" . $a . "` = " . (string) $this -> Name      ;
  }                                                        ;
  return ""                                                ;
}

public function ItemPairs($items)
{
  $I = array ( )                                 ;
  foreach ( $items as $i )                       {
    array_push ( $I , $this -> ItemPair ( $i ) ) ;
  }                                              ;
  $L = implode ( " and " , $I )                  ;
  unset        (           $I )                  ;
  return $L                                      ;
}

public function QueryItems($items,$Options = "",$Limits = "")
{
  $Q = " where " . $this -> ItemPairs ( $items )        ;
  $Q = $Q . $this -> OptionsTail ( $Options , $Limits ) ;
  return $Q                                             ;
}

public function SelectItems($Table,$items,$Options = "",$Limits = "")
{
  return "select " . $this -> Items ( ) . " from " . $Table         .
         $this -> QueryItems ( $items , $Options , $Limits ) . " ;" ;
}

public function SelectColumns($Table,$Options = "order by `priority` asc",$Limits = "")
{
  return $this -> SelectItems ( $Table           ,
                                $this -> Columns ,
                                $Options         ,
                                $Limits        ) ;
}

public function Select                                 (
                  $Table                               ,
                  $Options = "order by `priority` asc" ,
                  $Limits  = "limit 0,1"               )
{
  $L = array                (                                        ) ;
  array_push                ( $L , "uuid" , "locality" , "relevance" ) ;
  $Q = $this -> SelectItems ( $Table , $L , $Options , $Limits       ) ;
  unset                     ( $L                                     ) ;
  return $Q                                                            ;
}

public function SelectPosition($Table)
{
  $L = array                (             ) ;
  array_push                ( $L            ,
                              "uuid"        ,
                              "locality"    ,
                              "priority"    ,
                              "relevance" ) ;
  $Q = "select `id` from " . $Table         .
       $this -> QueryItems  ( $L ) . " ;"   ;
  unset                     ( $L          ) ;
  return $Q                                 ;
}

public function LastPriority($Table)
{
  $L = array                 (                          ) ;
  array_push                 ( $L                         ,
                               "uuid"                     ,
                               "locality"                 ,
                               "relevance"              ) ;
  $QQ = "select `priority` from " . $Table                .
         $this -> QueryItems ( $L                         ,
                               "order by `priority` desc" ,
                               "limit 0,1" ) . " ;"       ;
  unset                      ( $L                       ) ;
  return $QQ                                              ;
}

public function Insert($Table)
{
  return "insert into " . $Table              .
            " (`uuid`,"                       .
          "`locality`,"                       .
          "`priority`,"                       .
         "`relevance`,"                       .
             "`flags`,"                       .
              "`name`,"                       .
            "`length`)"                       .
            " values ("                       .
            (string) $this -> Uuid      . "," .
            (string) $this -> Locality  . "," .
            (string) $this -> Priority  . "," .
            (string) $this -> Relevance . "," .
            (string) $this -> Flags     . "," .
            "?,length(name)) ;"               ;
}

public function Delete($Table)
{
  $L  = array (                                                     ) ;
  array_push  ( $L , "uuid" , "locality" , "priority" , "relevance" ) ;
  $QQ = "delete from " . $Table                                       .
        $this -> QueryItems ( $L )                             . " ;" ;
  unset ( $L )                                                        ;
  return $QQ                                                          ;
}

public function DeleteId($Table)
{
  return "delete from {$Table} where `id` = {$this->Id} ;" ;
}

public function Update($Table)
{
  $L  = array (                                                     ) ;
  array_push  ( $L , "uuid" , "locality" , "priority" , "relevance" ) ;
  $QQ = "update " . $Table                                            .
        " set `name` = ? ,"                                           .
        " `flags` = " . $this -> Flags . " ,"                         .
        " `length` = length(name)"                                    .
        $this -> QueryItems ( $L )                             . " ;" ;
  unset ( $L )                                                        ;
  return $QQ                                                          ;
}

public function UpdateId($Table)
{
  return "update " . $Table                           .
         " set `name` = ? ,"                          .
             " `uuid` = " . $this -> Uuid . " ,"      .
         " `locality` = " . $this -> Locality . " ,"  .
         " `priority` = " . $this -> Priority . " ,"  .
        " `relevance` = " . $this -> Relevance . " ," .
            " `flags` = " . $this -> Flags . " ,"     .
           " `length` = length(`name`)"               .
         " where `id` = " . $this -> Id . " ;"        ;
}

public function obtain($R)
{
  $this -> Id        = $R [ "id"        ] ;
  $this -> Uuid      = $R [ "uuid"      ] ;
  $this -> Locality  = $R [ "locality"  ] ;
  $this -> Priority  = $R [ "priority"  ] ;
  $this -> Relevance = $R [ "relevance" ] ;
  $this -> Flags     = $R [ "flags"     ] ;
  $this -> Length    = $R [ "length"    ] ;
  $this -> Name      = $R [ "name"      ] ;
}

public function bindName($DbQuery)
{
  return $DbQuery -> bind_param ( 's' , $this -> Name ) ;
}

public function LastPosition($DB,$Table)
{
  $QQ = $this -> LastPriority ( $Table )      ;
  $ID = -1                                    ;
  $qq = $DB -> Query ( $QQ )                  ;
  if ( $DB -> hasResult ( $qq ) )             {
    $N  = $qq -> fetch_array  ( MYSQLI_BOTH ) ;
    $ID = $N [ "priority" ]                   ;
  }                                           ;
  $ID = $ID + 1                               ;
  return $ID                                  ;
}

public function Append($DB,$Table)
{
  if ( gmp_cmp ( $this -> Uuid , "0" ) <= 0 ) return false   ;
  $this -> Priority = $this -> LastPosition ( $DB , $Table ) ;
  $QQ = $this -> Insert   ( $Table )                         ;
  $qq = $DB   -> Prepare  ( $QQ    )                         ;
  $this       -> bindName ( $qq    )                         ;
  return $qq  -> execute  (        )                         ;
}

public function Sync($DB,$Table)
{
  if ( gmp_cmp ( $this -> Uuid , "0" ) <= 0 ) return false ;
  $QQ = $this -> Update   ( $Table )                       ;
  $qq = $DB   -> Prepare  ( $QQ    )                       ;
  $this       -> bindName ( $qq    )                       ;
  return $qq  -> execute  (        )                       ;
}

public function SyncId($DB,$Table)
{
  if ( gmp_cmp ( $this -> Uuid , "0" ) <= 0 ) return false ;
  $QQ = $this -> UpdateId ( $Table )                       ;
  $qq = $DB   -> Prepare  ( $QQ    )                       ;
  $this       -> bindName ( $qq    )                       ;
  return $qq  -> execute  (        )                       ;
}

public function Assure($DB,$Table)
{
  if ( $this -> Id <= 0 )                                        {
    $QQ = $this -> SelectPosition ( $Table )                     ;
    $qq = $DB   -> Query          ( $QQ    )                     ;
    if ( $DB -> hasResult ( $qq ) )                              {
      $N          = $qq -> fetch_array ( MYSQLI_BOTH )           ;
      $this -> Id = $N [ "id" ]                                  ;
    }                                                            ;
  }                                                              ;
  if ( $this -> Id > 0 ) return $this -> SyncId ( $DB , $Table ) ;
  return $this -> Append ( $DB , $Table )                        ;
}

public function ObtainsById($DB,$TABLE)
{
  $QQ = "select " . $this -> Items ( ) . " from {$TABLE}" .
        " where `id` = {$this -> Id} ;"                   ;
  $qq = $DB -> Query ( $QQ )                              ;
  if ( $DB -> hasResult ( $qq ) )                         {
    $rr = $qq -> fetch_array ( MYSQLI_BOTH )              ;
    $this -> obtain ( $rr )                               ;
    return true                                           ;
  }                                                       ;
  return false                                            ;
}

public function ObtainsForPriority($DB,$TABLE)
{
  $IDs = array ( )                                      ;
  $QQ  = "select `id` from `erp`.`names`"               .
            " where `uuid` = {$this -> Uuid}"           .
          " and `locality` = {$this -> Locality}"       .
         " and `relevance` = {$this -> Relevance}"      .
         " order by `priority` asc ;"                   ;
  $qq  = $DB -> Query ( $QQ )                           ;
  if ( $DB -> hasResult ( $qq ) )                       {
    while ( $rr = $qq -> fetch_array  ( MYSQLI_BOTH ) ) {
      array_push ( $IDs , $rr [ 0 ] )                   ;
    }                                                   ;
  }                                                     ;
  return $IDs                                           ;
}

public function FindByName($DB,$TABLE,$NAME)
{
  $TMP  = array ( )                        ;
  //////////////////////////////////////////
  $SPT  = "%{$NAME}%"                      ;
  //////////////////////////////////////////
  $QQ   = "select `uuid` from {$TABLE}"    .
          " where `name` like ?"           .
          " order by `ltime` desc ;"       ;
  $qq   = $DB -> Prepare    ( $QQ        ) ;
  $qq  -> bind_param        ( 's' , $SPT ) ;
  $qq  -> execute           (            ) ;
  $kk   = $qq -> get_result (            ) ;
  //////////////////////////////////////////
  $TMP  = $DB -> FetchUuids ( $kk , $TMP ) ;
  //////////////////////////////////////////
  return $TMP                              ;
}

public function ObtainsIDs($DB,$TABLE)
{
  $IDs = array ( )                                     ;
  $QQ  = "select `id` from `erp`.`names`"              .
         " where `uuid` = {$this -> Uuid}"             .
         " and `relevance` = {$this -> Relevance}"     .
         " order by `priority`,`locality` asc ;"       ;
  $qq  = $DB -> Query ( $QQ                          ) ;
  if                  ( $DB -> hasResult ($qq )      ) {
    while ( $rr = $qq -> fetch_array ( MYSQLI_BOTH ) ) {
      array_push ( $IDs , $rr [ 0 ] )                  ;
    }                                                  ;
  }                                                    ;
  return $IDs                                          ;
}

public function UpdateName($DB,$TABLE)
{
  $QQ  = "update {$TABLE}"                      .
           " set `name` = ?"                    .
         " , `locality` = {$this->Locality}"    .
           " , `length` = length(`name`)"       .
           " where `id` = {$this->Id} ;"        ;
  $qq  = $DB -> Prepare ( $QQ                 ) ;
  $qq -> bind_param     ( 's' , $this -> Name ) ;
  $qq -> execute        (                     ) ;
}

public function Editing($DB,$TABLE)
{
  if ( $this -> Id < 0 )                            {
    if ( strlen ( $this -> Name ) > 0 )             {
      $this -> Assure ( $DB , $TABLE )              ;
    }                                               ;
  } else                                            {
    if ( strlen ( $this -> Name ) > 0 )             {
      $this -> UpdateName ( $DB , $TABLE )          ;
    } else                                          {
      $DB -> Query ( $this -> DeleteId ( $TABLE ) ) ;
    }                                               ;
  }                                                 ;
}

// Table Locked
public function UpdatePriority($DB,$TABLE,$IDs)
{
  if ( count ( $IDs ) <= 0 ) return  ;
  $CC   = 0                          ;
  $DB -> LockWrite    ( $TABLE )     ;
  foreach ( $IDs as $id )            {
    $QQ  = "update {$TABLE}"         .
           " set `priority` = {$CC}" .
           " where `id` = {$id} ;"   ;
    $DB -> Query ( $QQ )             ;
    $CC  = $CC + 1                   ;
  }                                  ;
  $DB -> UnlockTables (        )     ;
}

// Table Locked
public function UpdateSmartly($DB,$TABLE)
{
  if                           ( $this -> Id < 0              ) {
    if                         ( strlen ( $this -> Name ) > 0 ) {
      ///////////////////////////////////////////////////////////
      // Append a new name
      ///////////////////////////////////////////////////////////
      $Priority = $this -> LastPosition ( $DB , $TABLE        ) ;
      ///////////////////////////////////////////////////////////
      $this -> set             ( "Priority"  , $Priority      ) ;
      $DB   -> LockWrite       ( $TABLE                       ) ;
      $this -> Assure          ( $DB         , $TABLE         ) ;
      $DB   -> UnlockTables    (                              ) ;
      ///////////////////////////////////////////////////////////
    }                                                           ;
  } else                                                        {
    if                         ( strlen ( $this->Name ) > 0 )   {
      // Update name content by Id
      $QQ  = "update {$TABLE}"                                  .
               " set `name` = ?"                                .
             " , `locality` = {$this->Locality}"                .
               " , `length` = length(`name`) "                  .
                "where `id` = {$this->Id} ;"                    ;
      $DB -> LockWrite         ( $TABLE                       ) ;
      $qq  = $DB -> Prepare    ( $QQ                          ) ;
      $qq -> bind_param        ( 's' , $this -> Name          ) ;
      $qq -> execute           (                              ) ;
      $DB -> UnlockTables      (                              ) ;
    } else                                                      {
      // Name is empty, delete it
      $QQ  = $this -> DeleteId ( $TABLE                       ) ;
      $DB -> LockWrite         ( $TABLE                       ) ;
      $DB -> Query             ( $QQ                          ) ;
      $DB -> UnlockTables      (                              ) ;
    }                                                           ;
  }                                                             ;
}

public function CreateInput($ID,$CLASSID,$NAME)
{
  $HI  = new HtmlTag (                       ) ;
  $HI -> setInput    (                       ) ;
  $HI -> AddPair     ( "type"  , "text"      ) ;
  $HI -> SafePair    ( "id"    , $ID         ) ;
  $HI -> SafePair    ( "name"  , $CLASSID    ) ;
  $HI -> AddPair     ( "class" , "NameInput" ) ;
  $HI -> AddPair     ( "size"  , "80"        ) ;
  $HI -> SafePair    ( "value" , $NAME       ) ;
  return $HI                                   ;
}

public function SelectLanguage($LANG,$PREFIX="language")
{
  $TI  = ""                                                  ;
  if ( $this -> Id >= 0 ) $TI = $this -> Id ; else $TI = "X" ;
  ////////////////////////////////////////////////////////////
  $LL  = $LANG -> EchoSelections ( $this -> Locality       ) ;
  $KK  = "{$PREFIX}-{$TI}"                                   ;
  $LL -> AddPair                 ( "id" , $KK              ) ;
  if ( $this -> Id >= 0 )                                    {
    $JFX = "namesChanged('{$this->Uuid}','{$this->Id}') ;"   ;
    $LL -> AddPair               ( "onchange" , $JFX       ) ;
  }                                                          ;
  ////////////////////////////////////////////////////////////
  return $LL                                                 ;
}

public function InputLine($PREFIX="linguist")
{
  ////////////////////////////////////////////////////////////
  global $Translations                                       ;
  $NA  = $Translations [ "Names::Append" ]                   ;
  ////////////////////////////////////////////////////////////
  $TI  = ""                                                  ;
  if ( $this -> Id >= 0 ) $TI = $this -> Id ; else $TI = "X" ;
  $KL  = "{$PREFIX}-{$TI}"                                   ;
  ////////////////////////////////////////////////////////////
  $JFX = "namesChanged('{$this->Uuid}','{$this->Id}') ;"     ;
  $NL  = $this -> CreateInput ( $KL , "" ,""               ) ;
  $NL -> AddPair              ( "onchange" , $JFX          ) ;
  if ( $this -> Id >= 0 )                                    {
    $NL -> SafePair           ( "value"    , $this -> Name ) ;
  } else                                                     {
    $NL -> AddPair            ( "placeholder" , $NA        ) ;
  }                                                          ;
  ////////////////////////////////////////////////////////////
  return $NL                                                 ;
}

public function InputArea($PREFIX="linguist")
{
  ////////////////////////////////////////////////////////////
  global $Translations                                       ;
  $NA    = $Translations [ "Names::Append" ]                 ;
  ////////////////////////////////////////////////////////////
  $TI    = ""                                                ;
  if ( $this -> Id >= 0 ) $TI = $this -> Id ; else $TI = "X" ;
  ////////////////////////////////////////////////////////////
  $KL    = "{$PREFIX}-{$TI}"                                 ;
  ////////////////////////////////////////////////////////////
  $CLN   = substr_count ( $this -> Name , "\n" )             ;
  $CLN   = $CLN + 1                                          ;
  $JFX   = "namesChanged('{$this->Uuid}','{$this->Id}') ;"   ;
  ////////////////////////////////////////////////////////////
  $NL    = new HtmlTag  (                      )             ;
  $NL   -> setTag       ( "textarea"           )             ;
  $NL   -> AddPair      ( "id"       , $KL     )             ;
  $NL   -> AddPair      ( "onchange" , $JFX    )             ;
  $NL   -> AddPair      ( "cols"     , "120"   )             ;
  $NL   -> AddPair      ( "rows"     , $CLN    )             ;
  ////////////////////////////////////////////////////////////
  if                    ( $this -> Id >= 0     )             {
    $NL -> AddText      ( $this -> Name        )             ;
  } else                                                     {
    $NL -> AddPair      ( "placeholder" , $NA  )             ;
  }                                                          ;
  ////////////////////////////////////////////////////////////
  return $NL                                                 ;
}

public function InputLineTd($HR,$LANG,$LANGUAGE="language",$LINGUIST="linguist")
{
  $LL = $this -> SelectLanguage ( $LANG    , $LANGUAGE ) ;
  $NL = $this -> InputLine      ( $LINGUIST            ) ;
  ////////////////////////////////////////////////////////
  $HD  = $HR -> addTd           (                      ) ;
  $HD -> AddPair                ( "valign" , "bottom"  ) ;
  $HD -> AddPair                ( "width"  , "3%"      ) ;
  $HD -> AddTag                 ( $LL                  ) ;
  ////////////////////////////////////////////////////////
  $HD  = $HR -> addTd           (                      ) ;
  $HD -> AddPair                ( "valign" , "bottom"  ) ;
  $HD -> AddTag                 ( $NL                  ) ;
}

public function InputAreaTd($HR,$LANG,$LANGUAGE="language",$LINGUIST="linguist")
{
  $LL = $this -> SelectLanguage ( $LANG    , $LANGUAGE ) ;
  $NL = $this -> InputArea      ( $LINGUIST            ) ;
  ////////////////////////////////////////////////////////
  $HD  = $HR -> addTd           (                      ) ;
  $HD -> AddPair                ( "valign" , "top"     ) ;
  $HD -> AddPair                ( "width"  , "3%"      ) ;
  $HD -> AddTag                 ( $LL                  ) ;
  ////////////////////////////////////////////////////////
  $HD  = $HR -> addTd           (                      ) ;
  $HD -> AddPair                ( "valign" , "top"     ) ;
  $HD -> AddTag                 ( $NL                  ) ;
}

public function InputTd($HR,$LANG,$AREA=false,$LANGUAGE="language",$LINGUIST="linguist")
{
  if ( $AREA )                                                   {
    $this -> InputAreaTd ( $HR , $LANG , $LANGUAGE , $LINGUIST ) ;
  } else                                                         {
    $this -> InputLineTd ( $HR , $LANG , $LANGUAGE , $LINGUIST ) ;
  }                                                              ;
}

public function NameTd($DB,$TABLE,$HB,$LANG,$AREA=false,$LANGUAGE="language",$LINGUIST="linguist")
{
  if ( $this -> Id >= 0 )                                                {
    $this -> ObtainsById ( $DB , $TABLE                                ) ;
  }                                                                      ;
  ////////////////////////////////////////////////////////////////////////
  $HR    = $HB -> addTr  (                                             ) ;
  $this -> InputTd       ( $HR , $LANG , $AREA , $LANGUAGE , $LINGUIST ) ;
}

public function NamesEditor($DB,$LANG,$CURRENT,$AREA=false,$LANGUAGE="language",$LINGUIST="linguist")
{
  $IDs = $this -> ObtainsIDs   ( $DB  , "`erp`.`names`" ) ;
  array_push                   ( $IDs , -1              ) ;
  /////////////////////////////////////////////////////////
  $HT  = new HtmlTag           (                        ) ;
  $HB  = $HT -> ConfigureTable (                        ) ;
  /////////////////////////////////////////////////////////
  foreach ( $IDs as $id )                                 {
    $this -> set               ( "id"       , $id       ) ;
    $this -> set               ( "locality" , $CURRENT  ) ;
    $this -> NameTd            ( $DB                      ,
                                 "`erp`.`names`"          ,
                                 $HB                      ,
                                 $LANG                    ,
                                 $AREA                    ,
                                 $LANGUAGE                ,
                                 $LINGUIST              ) ;
  }                                                       ;
  /////////////////////////////////////////////////////////
  return $HT                                              ;
}

//////////////////////////////////////////////////////////////////////////////
}

//////////////////////////////////////////////////////////////////////////////
?>

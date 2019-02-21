#include "nations.hpp"
#include "stdlib.h"
#include "string.h"
#include "ctype.h"

#pragma pack(push,1)


#pragma pack(pop)

#ifndef DONT_USE_NAMESPACE
namespace NATIONS_NAMESPACE {
#endif

Nation:: Nation (void)
{
}

Nation::~Nation (void)
{
}

bool Nation::isEqual(int16_t code)
{
  return ( Code == code ) ;
}

bool Nation::isEqual(const char * alpha)
{
  if ( nullptr == alpha ) return false ;
  int  len = strlen ( alpha )          ;
  if ( len > 4 ) return false          ;
  if ( len < 2 ) return false          ;
  //////////////////////////////////////
  const char * p = nullptr             ;
  switch ( len )                       {
    case 2: p = Two   ; break          ;
    case 3: p = Three ; break          ;
    case 4: p = Four  ; break          ;
  }                                    ;
  if ( nullptr == p ) return false     ;
  //////////////////////////////////////
  for (int i = 0 ; i < len ; i++ )     {
    char c = p     [ i ]               ;
    char z = alpha [ i ]               ;
    c = tolower ( c )                  ;
    z = tolower ( z )                  ;
    if ( c != z ) return false         ;
  }                                    ;
  //////////////////////////////////////
  return true                          ;
}

#ifndef DONT_USE_NAMESPACE
}
#endif

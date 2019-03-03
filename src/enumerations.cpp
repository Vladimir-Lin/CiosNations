#include "nations.hpp"

#ifndef DONT_USE_NAMESPACE
namespace NATIONS_NAMESPACE {
#endif

#ifndef DISABLE_NATION_ENUMS

LIBNATIONS_EXPORT const char * NationTypeStrings [ ] = {
  "Any"                              , // 0
  "Country"                          , // 1
  "Region"                           , // 2
  "Dispute"                          , // 3
  "Spiritual"                        , // 4
  "Expired"                          , // 5
  "Historical"                       , // 6
  "Fiction"                          , // 7
  "Virtual"                          , // 8
  "Others"                           , // 9
  nullptr                          } ;

LIBNATIONS_EXPORT const char * NationActivationStrings [ ] = {
  "Unused"                                 , // 0
  "Using"                                  , // 1
  "Editing"                                , // 2
  "Suspension"                             , // 3
  nullptr                                } ;

#endif

#ifndef DONT_USE_NAMESPACE
}
#endif

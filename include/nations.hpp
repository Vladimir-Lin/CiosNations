/****************************************************************************\
 *
 *                         ISO 3166 Country Supports
 *
\****************************************************************************/

#ifndef CIOS_NATIONS_HPP
#define CIOS_NATIONS_HPP

#if defined (WIN32) && defined(BUILD_SHARED_LIBS)
  #if defined (_MSC_VER)
    #pragma warning(disable: 4251)
  #endif
  #if defined(EXPORT_LIBNATIONS)
    #define LIBNATIONS_EXPORT __declspec(dllexport)
  #else
    #define LIBNATIONS_EXPORT __declspec(dllimport)
  #endif
#else
    #define LIBNATIONS_EXPORT
#endif

#include <stdint.h>
#include <stdio.h>

#if !defined(NATIONS_NAMESPACE)
#define NATIONS_NAMESPACE Nations
#endif

#ifndef DONT_USE_NAMESPACE
namespace NATIONS_NAMESPACE {
#endif

class LIBNATIONS_EXPORT Nation ;

#pragma pack(push,1)

typedef struct       {
  int32_t      Id    ;
  uint64_t     Uuid  ;
  int8_t       Type  ;
  int8_t       Used  ;
  int16_t      Code  ;
  const char * Two   ;
  const char * Three ;
  const char * Four  ;
  const char * Name  ;
} NationItem         ;

#pragma pack(pop)


class LIBNATIONS_EXPORT Nation
{
  public:

    int32_t  Id    ;
    uint64_t Uuid  ;
    int8_t   Type  ;
    int8_t   Used  ;
    int16_t  Code  ;
    char   * Two   ;
    char   * Three ;
    char   * Four  ;
    char   * Name  ;

    explicit Nation (void) ;
    virtual ~Nation (void) ;

  protected:

  private:

} ;

#ifndef DONT_USE_NAMESPACE
}
#endif

#endif

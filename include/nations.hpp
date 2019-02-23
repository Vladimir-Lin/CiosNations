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

extern NationItem DefaultNations [ ] ;

#pragma pack(pop)

class LIBNATIONS_EXPORT Nation
{
  public:

    typedef enum
      Types          {
      Any        = 0 ,
      Country    = 1 ,
      Region     = 2 ,
      Dispute    = 3 ,
      Spiritual  = 4 ,
      Expired    = 5 ,
      Historical = 6 ,
      Fiction    = 7 ,
      Virtual    = 8 ,
      Others     = 9 }
      Types          ;

    typedef enum
      Activations    {
      Unused     = 0 ,
      Using      = 1 ,
      Editing    = 2 ,
      Suspension = 3 }
      Activations    ;

    int32_t  Id    ; // SQL Sequence Id
    uint64_t Uuid  ; // 7400000000000000001 ~  7400000000001000000
    int8_t   Type  ; // Types
    int8_t   Used  ; // Activations
    int16_t  Code  ; // ISO 3166-1 Country Code, 0 for stop list
    char   * Two   ; // ISO 3166-1 Alpha-2 Code
    char   * Three ; // ISO 3166-1 Alpha-3 Code
    char   * Four  ; // ISO 3166-3 Four-letter code
    char   * Name  ; // Country English Name

    explicit Nation  (void) ;
             Nation  (const Nation & nation) ;
    virtual ~Nation  (void) ;

    Nation & assign  (const Nation & nation) ;

    bool     isEqual (int16_t code) ;
    bool     isEqual (const char * alpha) ;

  protected:

  private:

} ;

#ifndef DONT_USE_NAMESPACE
}
#endif

#endif

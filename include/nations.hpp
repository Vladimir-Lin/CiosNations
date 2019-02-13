/****************************************************************************\
 *
 *                         CIOS Color Spaces
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

class LIBNATIONS_EXPORT RGBA       ;

#ifndef DONT_USE_NAMESPACE
}
#endif

#endif

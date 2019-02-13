#include "colors.hpp"
#include "stdlib.h"
#include "math.h"

#ifndef VerySmall
#define VerySmall   0.00000000000000000000000000000000000001
#endif

#define SkinColorY  0.03
#define MinI        0.0750
#define MaxI        0.3450
#define MinQ       -0.0410
#define MaxQ        0.0410

#pragma pack(push,1)


#pragma pack(pop)

#ifndef DONT_USE_NAMESPACE
namespace COLORS_NAMESPACE {
#endif

static double ColorSpaceVerySmallNumber = VerySmall ;

ColorSpace:: ColorSpace (void)
{
}

ColorSpace::~ColorSpace (void)
{
}

void ColorSpace::setVerySmall (double vs)
{
  ColorSpaceVerySmallNumber = vs ;
}

bool ColorSpace::Equal(double a,double b)
{
  double v = ( a - b )                     ;
  if ( v < 0 ) v = -v                      ;
  return ( v < ColorSpaceVerySmallNumber ) ;
}

bool ColorSpace::isSkin(uint32_t c)
{
  COLORS_NAMESPACE :: YIQ yiq ( c )        ;
  if ( yiq . Y < SkinColorY ) return false ;
  if ( yiq . I < MinI       ) return false ;
  if ( yiq . I > MaxI       ) return false ;
  if ( yiq . Q < MinQ       ) return false ;
  if ( yiq . Q > MaxQ       ) return false ;
  return true                              ;
}

uint32_t ColorSpace::RGB(double R,double G,double B)
{
  return 0 ;
}

uint32_t ColorSpace::YUV(double Y,double U,double V)
{
  return 0 ;
}

uint32_t ColorSpace::YIQ(double Y,double I,double Q)
{
  return 0 ;
}

uint32_t ColorSpace::XYZ(double X,double Y,double Z)
{
  return 0 ;
}

uint32_t ColorSpace::Lab(double L,double a,double b)
{
  return 0 ;
}

uint32_t ColorSpace::LUV(double L,double U,double V)
{
  return 0 ;
}

#ifndef DONT_USE_NAMESPACE
}
#endif

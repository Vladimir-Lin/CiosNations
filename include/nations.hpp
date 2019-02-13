/****************************************************************************\
 *
 *                         CIOS Color Spaces
 *
\****************************************************************************/

#ifndef CIOS_COLORS_HPP
#define CIOS_COLORS_HPP

#if defined (WIN32) && defined(BUILD_SHARED_LIBS)
  #if defined (_MSC_VER)
    #pragma warning(disable: 4251)
  #endif
  #if defined(EXPORT_LIBCOLORS)
    #define LIBCOLORS_EXPORT __declspec(dllexport)
  #else
    #define LIBCOLORS_EXPORT __declspec(dllimport)
  #endif
#else
    #define LIBCOLORS_EXPORT
#endif

#include <stdint.h>
#include <stdio.h>

#if !defined(COLORS_NAMESPACE)
#define COLORS_NAMESPACE Colors
#endif

#ifndef DONT_USE_NAMESPACE
namespace COLORS_NAMESPACE {
#endif

class LIBCOLORS_EXPORT RGBA       ;
class LIBCOLORS_EXPORT RGBA64     ;
class LIBCOLORS_EXPORT DoubleRGBA ;
class LIBCOLORS_EXPORT LUV        ;
class LIBCOLORS_EXPORT YUV        ;
class LIBCOLORS_EXPORT YIQ        ;
class LIBCOLORS_EXPORT XYZ        ;
class LIBCOLORS_EXPORT Lab        ;
class LIBCOLORS_EXPORT ColorSpace ;

class LIBCOLORS_EXPORT RGBA
{
  public:

    uint8_t R ;
    uint8_t G ;
    uint8_t B ;
    uint8_t A ;

    explicit   RGBA         (uint8_t r,uint8_t g,uint8_t b,uint8_t a=255) ;
    explicit   RGBA         (void) ;
               RGBA         (const RGBA       & rgba ) ;
               RGBA         (const RGBA64     & rgba ) ;
               RGBA         (const DoubleRGBA & rgba ) ;
               RGBA         (const XYZ        & xyz  ) ;
               RGBA         (const Lab        & lab  ) ;
               RGBA         (const uint32_t     pixel) ;
               RGBA         (const uint64_t     pixel) ;
    virtual   ~RGBA         (void) ;

    RGBA     & operator   = (const RGBA       & rgba) ;
    RGBA     & operator   = (const RGBA64     & rgba) ;
    RGBA     & operator   = (const DoubleRGBA & rgba) ;
    RGBA     & operator   = (const XYZ        & xyz ) ;
    RGBA     & operator   = (const Lab        & lab ) ;

    RGBA     & setR         (uint8_t r) ;
    RGBA     & setG         (uint8_t g) ;
    RGBA     & setB         (uint8_t b) ;
    RGBA     & setA         (uint8_t a) ;

    RGBA     & setComponent (char C,uint8_t v) ;

    uint8_t    Value        (char C) ;

    uint32_t   toPixel      (void) ; // ARGB , A is upper bits
    RGBA     & setPixel     (uint32_t v) ; // ARGB , A is upper bits
    RGBA     & setPixel     (uint64_t v) ; // ARGB , A is upper bits

    RGBA64     toRGBA64     (void) const ;
    DoubleRGBA toDouble     (void) const ;

  protected:

  private:

} ;

class LIBCOLORS_EXPORT RGBA64
{
  public:

    uint16_t R ;
    uint16_t G ;
    uint16_t B ;
    uint16_t A ;

    explicit   RGBA64       (uint16_t r,uint16_t g,uint16_t b,uint16_t a=65535) ;
    explicit   RGBA64       (void) ;
               RGBA64       (const RGBA64     & rgba) ;
               RGBA64       (const RGBA       & rgba) ;
               RGBA64       (const DoubleRGBA & rgba) ;
    virtual   ~RGBA64       (void) ;

    RGBA64   & operator   = (const RGBA64     & rgba) ;
    RGBA64   & operator   = (const RGBA       & rgba) ;
    RGBA64   & operator   = (const DoubleRGBA & rgba) ;

    RGBA64   & setR         (uint16_t r) ;
    RGBA64   & setG         (uint16_t g) ;
    RGBA64   & setB         (uint16_t b) ;
    RGBA64   & setA         (uint16_t a) ;

    RGBA64   & setComponent (char C,uint16_t v) ;

    uint16_t   Value        (char C) ;

    uint64_t   Pixel        (void) ; // ARGB , A is upper bits
    RGBA64   & setPixel     (uint64_t v) ; // ARGB , A is upper bits

    RGBA       toRGBA       (void) const ;
    DoubleRGBA toDouble     (void) const ;

  protected:

  private:

} ;

class LIBCOLORS_EXPORT DoubleRGBA
{
  public:

    double R ;
    double G ;
    double B ;
    double A ;

    explicit     DoubleRGBA   (double r,double g,double b,double a=1.0) ;
    explicit     DoubleRGBA   (void) ;
                 DoubleRGBA   (const DoubleRGBA & rgba) ;
                 DoubleRGBA   (const RGBA       & rgba) ;
                 DoubleRGBA   (const RGBA64     & rgba) ;
    virtual     ~DoubleRGBA   (void) ;

    DoubleRGBA & operator   = (const DoubleRGBA & rgba) ;
    DoubleRGBA & operator   = (const       RGBA & rgba) ;
    DoubleRGBA & operator   = (const     RGBA64 & rgba) ;

    DoubleRGBA & setR         (double r) ;
    DoubleRGBA & setG         (double g) ;
    DoubleRGBA & setB         (double b) ;
    DoubleRGBA & setA         (double a) ;

    DoubleRGBA & setComponent (char C,double v) ;

    double       Value        (char C) ;

    RGBA         toRGBA       (void) const ;
    RGBA64       toRGBA64     (void) const ;

  protected:

  private:

} ;

class LIBCOLORS_EXPORT LUV
{
  public:

    double L ; // [   0.0000 , 100.0000 ]
    double U ; // [ -83.0798 , 175.0530 ]
    double V ; // [ -21.0972 , 435.3520 ]

    explicit     LUV   (double L,double U,double V) ;
    explicit     LUV   (void) ;
                 LUV   (const LUV & luv) ;
    virtual     ~LUV   (void) ;

    LUV        & operator =  (const LUV & luv) ;

    LUV        & setXYZ    (const XYZ & xyz) ;
    XYZ          toXYZ     (void) const ;

  protected:

  private:

} ;

class LIBCOLORS_EXPORT YUV
{
  public:

    double Y ; // [  0.000 ,  1.000 ]
    double U ; // [ -0.436 ,  0.436 ]
    double V ; // [ -0.615 ,  0.615 ]

    explicit     YUV        (double Y,double U,double V) ;
    explicit     YUV        (void) ;
                 YUV        (const YUV & yuv) ;
    virtual     ~YUV        (void) ;

    YUV        & operator = (const YUV & yiq) ;

    YUV        & setDouble  (DoubleRGBA & rgba) ;
    DoubleRGBA   toDouble   (void) ;

  protected:

  private:

} ;

class LIBCOLORS_EXPORT YIQ
{
  public:

    double Y ; // [  0.000000 ,  1.000000 ]
    double I ; // [ -0.595716 ,  0.595716 ]
    double Q ; // [ -0.522591 ,  0.522591 ]

    explicit     YIQ        (double Y,double I,double Q) ;
    explicit     YIQ        (void) ;
                 YIQ        (const YIQ & yiq) ;
                 YIQ        (const uint32_t pixel) ;
    virtual     ~YIQ        (void) ;

    YIQ        & operator = (const YIQ & yiq) ;

    YIQ &        setDouble  (DoubleRGBA & rgba) ;
    DoubleRGBA   toDouble   (void) ;

  protected:

  private:

} ;

// CIE XYZ
class LIBCOLORS_EXPORT XYZ
{
  public:

    double X ; // [ 0.0 , 0.95047 ]
    double Y ; // [ 0.0 , 1.00000 ]
    double Z ; // [ 0.0 , 1.08883 ]

    explicit     XYZ         (double X,double Y,double Z) ;
    explicit     XYZ         (void) ;
                 XYZ         (const XYZ        & xyz ) ;
                 XYZ         (const RGBA       & rgba) ;
                 XYZ         (const RGBA64     & rgba) ;
                 XYZ         (const DoubleRGBA & rgba) ;
                 XYZ         (const Lab        & lab ) ;
    virtual     ~XYZ         (void) ;

    XYZ        & operator =  (const XYZ & xyz) ;

    XYZ        & setRgba     (const RGBA       & rgba) ;
    XYZ        & setRgba64   (const RGBA64     & rgba) ;
    XYZ        & setDouble   (const DoubleRGBA & rgba) ;
    RGBA         toRGBA      (void) const ;
    RGBA64       toRGBA64    (void) const ;
    DoubleRGBA   toDouble    (void) const ;

    double       Gamma       (double v) const ;
    double       invertGamma (double r) const ;

  protected:

  private:

} ;

// CIE Lab
class LIBCOLORS_EXPORT Lab
{
  public:

    double L ; // [    0.0000 , 100.0000 ]
    double a ; // [ - 86.1846 ,  98.2542 ]
    double b ; // [ -107.8640 ,  94.4825 ]

    explicit     Lab       (double L,double a,double b) ;
    explicit     Lab       (void) ;
                 Lab       (const Lab        & lab  ) ;
                 Lab       (const RGBA       & rgba ) ;
                 Lab       (const RGBA64     & rgba ) ;
                 Lab       (const DoubleRGBA & rgba ) ;
                 Lab       (const LUV        & luv  ) ;
                 Lab       (const YUV        & yuv  ) ;
                 Lab       (const YIQ        & yiq  ) ;
                 Lab       (const XYZ        & xyz  ) ;
                 Lab       (const uint32_t     pixel) ;
                 Lab       (const uint64_t     pixel) ;
    virtual     ~Lab       (void) ;

    double       Forward   (double p) const ;
    double       Backward  (double p) const ;

    Lab        & setXYZ    (const XYZ & xyz) ;
    XYZ          toXYZ     (void) const ;

    Lab        & setRgba   (const RGBA & rgba) ;
    RGBA         toRGBA    (void) const ;

    Lab        & setRgba64 (const RGBA64 & rgba) ;
    RGBA64       toRGBA64  (void) const ;

    Lab        & setDouble (const RGBA & rgba) ;
    DoubleRGBA   toDouble  (void) const ;

  protected:

  private:

} ;

class LIBCOLORS_EXPORT ColorSpace
{
  public:

    explicit      ColorSpace   (void) ;
    virtual      ~ColorSpace   (void) ;

    static uint32_t RGB          (double R,double G,double B) ;
    static uint32_t YUV          (double Y,double U,double V) ;
    static uint32_t YIQ          (double Y,double I,double Q) ;
    static uint32_t XYZ          (double X,double Y,double Z) ;
    static uint32_t Lab          (double L,double a,double b) ;
    static uint32_t LUV          (double L,double U,double V) ;

    static bool     isSkin       (uint32_t c) ;

    static void     setVerySmall (double vs) ;
    static bool     Equal        (double a,double b) ;

  protected:

  private:

} ;

#ifndef DONT_USE_NAMESPACE
}
#endif

#endif

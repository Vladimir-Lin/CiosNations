cmake_minimum_required(VERSION 3.0)
PROJECT(libcolors)
INCLUDE (CheckIncludeFile)

option(NONAMESPACE "Don't use namespace in the header" off)

include_directories(include)

# Header
SET(HEADERS include/colors.hpp)

# Source codes
SET(CORES
  src/rgba.cpp
  src/rgba64.cpp
  src/doubleRgba.cpp
  src/yuv.cpp
  src/yiq.cpp
  src/luv.cpp
  src/lab.cpp
  src/xyz.cpp
  src/cmyk.cpp
  src/ryb.cpp
  src/hsv.cpp
  src/hsl.cpp
  src/hcl.cpp
  src/colorspace.cpp)

if(NONAMESPACE)
  add_definitions("-DDONT_USE_NAMESPACE=1")
endif(NONAMESPACE)

if(BUILD_SHARED_LIBS)
  add_library(libcolors SHARED ${CORES} ${HEADERS})
  target_link_libraries(libcolors m)
  add_definitions("-DBUILD_SHARED_LIBS=1")
  add_definitions("-EXPORT_LIBCOLORS=1")
  install(TARGETS libcolors
    RUNTIME DESTINATION bin
    LIBRARY DESTINATION lib
    ARCHIVE DESTINATION lib)
  install(FILES include/colors.hpp DESTINATION include)
else(BUILD_SHARED_LIBS)
  add_library(libcolors STATIC ${CORES} ${HEADERS})
  target_link_libraries(libcolors m)
  install(TARGETS libcolors DESTINATION lib)
  install(FILES include/colors.hpp DESTINATION include)
endif(BUILD_SHARED_LIBS)

cmake_minimum_required(VERSION 3.0)
project(libnations)
include(CheckIncludeFile)

option(NONAMESPACE "Don't use namespace in the header" off)

include_directories(include)

# Header
set(HEADERS include/nations.hpp)

# Source codes
set(CORES
  src/nation.cpp
  src/countries.cpp
  src/extended.cpp
  src/enumerations.cpp)

if(NONAMESPACE)
  add_definitions("-DDONT_USE_NAMESPACE=1")
endif(NONAMESPACE)

if (CMAKE_BUILD_TYPE STREQUAL Debug)
  add_definitions("-DCIOSDEBUG=1")
endif()

if(BUILD_SHARED_LIBS)
  add_library(libnations SHARED ${CORES} ${HEADERS})
#  target_link_libraries(libnations m)
  add_definitions("-DBUILD_SHARED_LIBS=1")
  add_definitions("-DEXPORT_LIBNATIONS=1")
  install(TARGETS libnations
    RUNTIME DESTINATION bin
    LIBRARY DESTINATION lib
    ARCHIVE DESTINATION lib)
  install(FILES include/nations.hpp DESTINATION include)
else(BUILD_SHARED_LIBS)
  add_library(libnations STATIC ${CORES} ${HEADERS})
#  target_link_libraries(libnations m)
  install(TARGETS libnations DESTINATION lib)
  install(FILES include/nations.hpp DESTINATION include)
endif(BUILD_SHARED_LIBS)

# Handling compilers in different platforms

# using Clang
if(CMAKE_CXX_COMPILER_ID STREQUAL Clang)
endif()

# using GCC
if(CMAKE_CXX_COMPILER_ID STREQUAL GNU)
endif()

# using Intel C++
if(CMAKE_CXX_COMPILER_ID STREQUAL Intel)
endif()

# using Visual Studio C++
if(MSVC)
  # message( ${CMAKE_CXX_COMPILER} )
  add_definitions("/wd4819")
  add_definitions("/nologo")
endif(MSVC)

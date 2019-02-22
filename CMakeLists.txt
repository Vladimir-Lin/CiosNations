cmake_minimum_required(VERSION 3.0)
PROJECT(libnations)
INCLUDE (CheckIncludeFile)

option(NONAMESPACE "Don't use namespace in the header" off)

include_directories(include)

# Header
SET(HEADERS include/nations.hpp)

# Source codes
SET(CORES
  src/nation.cpp
  src/countries.cpp)

if(NONAMESPACE)
  add_definitions("-DDONT_USE_NAMESPACE=1")
endif(NONAMESPACE)

if(BUILD_SHARED_LIBS)
  add_library(libnations SHARED ${CORES} ${HEADERS})
#  target_link_libraries(libnations m)
  add_definitions("-DBUILD_SHARED_LIBS=1")
  add_definitions("-EXPORT_LIBNATIONS=1")
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

QT          -= gui
TARGET       = libnations
TEMPLATE     = lib
DEFINES     += QT_DEPRECATED_WARNINGS
DEFINES     += EXPORT_LIBNATIONS

SRCROOT      = ../
INCLUDEPATH  = $$SRCROOT/include
SRCPATH      = $$SRCROOT/src

HEADERS     += $$SRCROOT/include/nations.hpp

SOURCES     += $$SRCPATH/nation.cpp
SOURCES     += $$SRCPATH/countries.cpp

OTHER_FILES += $$SRCROOT/CMakeLists.txt

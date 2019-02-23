# Author : Foxman A.K.A. Vladimir Lin <lin.vladimir@gmail.com>
# Lastest update : 2019/02/23 20:19

QT          -= gui
TARGET       = libnations
TEMPLATE     = lib
DEFINES     += QT_DEPRECATED_WARNINGS
DEFINES     += EXPORT_LIBNATIONS

SRCROOT      = ../
SRCPATH      = $$SRCROOT/src

INCLUDEPATH  = $$SRCROOT/include

HEADERS     += $$SRCROOT/include/nations.hpp

SOURCES     += $$SRCPATH/nation.cpp
SOURCES     += $$SRCPATH/countries.cpp
SOURCES     += $$SRCPATH/extended.cpp
SOURCES     += $$SRCPATH/enumerations.cpp

OTHER_FILES += $$SRCROOT/CMakeLists.txt
OTHER_FILES += $$SRCROOT/projects/index.xml

OTHER_FILES += $$SRCROOT/docs/index.html
OTHER_FILES += $$SRCROOT/docs/tw/index.html
OTHER_FILES += $$SRCROOT/docs/en/index.html
OTHER_FILES += $$SRCROOT/docs/cn/index.html
OTHER_FILES += $$SRCROOT/docs/css/nations.css

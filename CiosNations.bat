@echo off

set LIBRARIES=^
libexpat

for %%i in (%LIBRARIES%) do (
  @call %~dp0\%%i\%%i.bat
)

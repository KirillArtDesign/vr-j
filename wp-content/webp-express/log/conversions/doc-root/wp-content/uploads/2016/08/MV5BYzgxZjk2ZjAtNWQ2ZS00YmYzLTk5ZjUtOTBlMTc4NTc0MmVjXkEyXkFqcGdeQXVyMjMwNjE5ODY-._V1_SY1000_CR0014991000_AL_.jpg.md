WebP Express 0.17.2. Conversion triggered with the conversion script (wod/webp-on-demand.php), 2019-11-22 11:35:50

*WebP Convert 2.3.0*  ignited.
- PHP version: 7.0.33-0+deb9u6
- Server software: Apache/2.4.25 (Debian)

Stack converter ignited
Destination folder does not exist. Creating folder: [doc-root]/wp-content/webp-express/webp-images/doc-root/wp-content/uploads/2016/08

Options:
------------
The following options have been set explicitly. Note: it is the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options.
- source: [doc-root]/wp-content/uploads/2016/08/MV5BYzgxZjk2ZjAtNWQ2ZS00YmYzLTk5ZjUtOTBlMTc4NTc0MmVjXkEyXkFqcGdeQXVyMjMwNjE5ODY-._V1_SY1000_CR0014991000_AL_.jpg
- destination: [doc-root]/wp-content/webp-express/webp-images/doc-root/wp-content/uploads/2016/08/MV5BYzgxZjk2ZjAtNWQ2ZS00YmYzLTk5ZjUtOTBlMTc4NTc0MmVjXkEyXkFqcGdeQXVyMjMwNjE5ODY-._V1_SY1000_CR0014991000_AL_.jpg.webp
- log-call-arguments: true
- converters: (array of 9 items)

The following options have not been explicitly set, so using the following defaults:
- converter-options: (empty array)
- shuffle: false
- preferred-converters: (empty array)
- extra-converters: (empty array)

The following options were supplied and are passed on to the converters in the stack:
- encoding: "auto"
- metadata: "none"
- near-lossless: 60
- quality: 70
------------


*Trying: cwebp* 

Options:
------------
The following options have been set explicitly. Note: it is the resulting options after merging down the "jpeg" and "png" options and any converter-prefixed options.
- source: [doc-root]/wp-content/uploads/2016/08/MV5BYzgxZjk2ZjAtNWQ2ZS00YmYzLTk5ZjUtOTBlMTc4NTc0MmVjXkEyXkFqcGdeQXVyMjMwNjE5ODY-._V1_SY1000_CR0014991000_AL_.jpg
- destination: [doc-root]/wp-content/webp-express/webp-images/doc-root/wp-content/uploads/2016/08/MV5BYzgxZjk2ZjAtNWQ2ZS00YmYzLTk5ZjUtOTBlMTc4NTc0MmVjXkEyXkFqcGdeQXVyMjMwNjE5ODY-._V1_SY1000_CR0014991000_AL_.jpg.webp
- encoding: "auto"
- low-memory: true
- log-call-arguments: true
- metadata: "none"
- method: 6
- near-lossless: 60
- quality: 70
- use-nice: true
- command-line-options: ""
- try-common-system-paths: true
- try-supplied-binary-for-os: true

The following options have not been explicitly set, so using the following defaults:
- alpha-quality: 85
- auto-filter: false
- default-quality: 75
- max-quality: 85
- preset: "none"
- size-in-percentage: null (not set)
- skip: false
- rel-path-to-precompiled-binaries: *****
- try-cwebp: true
- try-discovering-cwebp: true
------------

Encoding is set to auto - converting to both lossless and lossy and selecting the smallest file

Converting to lossy
Looking for cwebp binaries.
Discovering if a plain cwebp call works (to skip this step, disable the "try-cwebp" option)
- Executing: cwebp -version. Result: *Exec failed* (the cwebp binary was not found at path: cwebp)
Nope a plain cwebp call does not work
Discovering binaries using "which -a cwebp" command. (to skip this step, disable the "try-discovering-cwebp" option)
Found 0 binaries
Discovering binaries by peeking in common system paths (to skip this step, disable the "try-common-system-paths" option)
Found 0 binaries
Discovering binaries which are distributed with the webp-convert library (to skip this step, disable the "try-supplied-binary-for-os" option)
Checking if we have a supplied precompiled binary for your OS (Linux)... We do. We in fact have 3
Found 3 binaries: 
- [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64
- [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64-static
- [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-061-linux-x86-64
Detecting versions of the cwebp binaries found
- Executing: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64 -version. Result: version: *1.0.3*
- Executing: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64-static -version. Result: *Exec failed* (the cwebp binary was not found at path: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64-static)
- Executing: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-061-linux-x86-64 -version. Result: version: *0.6.1*
Binaries ordered by version number.
- [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64: (version: 1.0.3)
- [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-061-linux-x86-64: (version: 0.6.1)
Trying the first of these. If that should fail (it should not), the next will be tried and so on.
Creating command line options for version: 1.0.3
Quality: 70. 
Consider setting quality to "auto" instead. It is generally a better idea
The near-lossless option ignored for lossy
Trying to convert by executing the following command:
nice [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64 -metadata none -q 70 -alpha_q '85' -m 6 -low_memory '[doc-root]/wp-content/uploads/2016/08/MV5BYzgxZjk2ZjAtNWQ2ZS00YmYzLTk5ZjUtOTBlMTc4NTc0MmVjXkEyXkFqcGdeQXVyMjMwNjE5ODY-._V1_SY1000_CR0014991000_AL_.jpg' -o '[doc-root]/wp-content/webp-express/webp-images/doc-root/wp-content/uploads/2016/08/MV5BYzgxZjk2ZjAtNWQ2ZS00YmYzLTk5ZjUtOTBlMTc4NTc0MmVjXkEyXkFqcGdeQXVyMjMwNjE5ODY-._V1_SY1000_CR0014991000_AL_.jpg.webp.lossy.webp' 2>&1

*Output:* 
Saving file '[doc-root]/wp-content/webp-express/webp-images/doc-root/wp-content/uploads/2016/08/MV5BYzgxZjk2ZjAtNWQ2ZS00YmYzLTk5ZjUtOTBlMTc4NTc0MmVjXkEyXkFqcGdeQXVyMjMwNjE5ODY-._V1_SY1000_CR0014991000_AL_.jpg.webp.lossy.webp'
File:      [doc-root]/wp-content/uploads/2016/08/MV5BYzgxZjk2ZjAtNWQ2ZS00YmYzLTk5ZjUtOTBlMTc4NTc0MmVjXkEyXkFqcGdeQXVyMjMwNjE5ODY-._V1_SY1000_CR0014991000_AL_.jpg
Dimension: 1499 x 1000
Output:    115926 bytes Y-U-V-All-PSNR 38.45 46.55 46.43   39.88 dB
           (0.62 bpp)
block count:  intra4:       3927  (66.31%)
              intra16:      1995  (33.69%)
              skipped:      1587  (26.80%)
bytes used:  header:            161  (0.1%)
             mode-partition:  19006  (16.4%)
 Residuals bytes  |segment 1|segment 2|segment 3|segment 4|  total
  intra4-coeffs:  |   86096 |    1381 |     615 |      73 |   88165  (76.1%)
 intra16-coeffs:  |    2166 |     288 |     442 |     218 |    3114  (2.7%)
  chroma coeffs:  |    4909 |     278 |     213 |      52 |    5452  (4.7%)
    macroblocks:  |      66%|       3%|       3%|      28%|    5922
      quantizer:  |      35 |      28 |      20 |      16 |
   filter level:  |      37 |      24 |      18 |      11 |
------------------+---------+---------+---------+---------+-----------------
 segments total:  |   93171 |    1947 |    1270 |     343 |   96731  (83.4%)

Success
Reduction: 37% (went from 179 kb to 113 kb)

Converting to lossless
Looking for cwebp binaries.
Discovering if a plain cwebp call works (to skip this step, disable the "try-cwebp" option)
- Executing: cwebp -version. Result: *Exec failed* (the cwebp binary was not found at path: cwebp)
Nope a plain cwebp call does not work
Discovering binaries using "which -a cwebp" command. (to skip this step, disable the "try-discovering-cwebp" option)
Found 0 binaries
Discovering binaries by peeking in common system paths (to skip this step, disable the "try-common-system-paths" option)
Found 0 binaries
Discovering binaries which are distributed with the webp-convert library (to skip this step, disable the "try-supplied-binary-for-os" option)
Checking if we have a supplied precompiled binary for your OS (Linux)... We do. We in fact have 3
Found 3 binaries: 
- [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64
- [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64-static
- [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-061-linux-x86-64
Detecting versions of the cwebp binaries found
- Executing: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64 -version. Result: version: *1.0.3*
- Executing: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64-static -version. Result: *Exec failed* (the cwebp binary was not found at path: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64-static)
- Executing: [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-061-linux-x86-64 -version. Result: version: *0.6.1*
Binaries ordered by version number.
- [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64: (version: 1.0.3)
- [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-061-linux-x86-64: (version: 0.6.1)
Trying the first of these. If that should fail (it should not), the next will be tried and so on.
Creating command line options for version: 1.0.3
Trying to convert by executing the following command:
nice [doc-root]/wp-content/plugins/webp-express/vendor/rosell-dk/webp-convert/src/Convert/Converters/Binaries/cwebp-103-linux-x86-64 -metadata none -q 70 -alpha_q '85' -near_lossless 60 -m 6 -low_memory '[doc-root]/wp-content/uploads/2016/08/MV5BYzgxZjk2ZjAtNWQ2ZS00YmYzLTk5ZjUtOTBlMTc4NTc0MmVjXkEyXkFqcGdeQXVyMjMwNjE5ODY-._V1_SY1000_CR0014991000_AL_.jpg' -o '[doc-root]/wp-content/webp-express/webp-images/doc-root/wp-content/uploads/2016/08/MV5BYzgxZjk2ZjAtNWQ2ZS00YmYzLTk5ZjUtOTBlMTc4NTc0MmVjXkEyXkFqcGdeQXVyMjMwNjE5ODY-._V1_SY1000_CR0014991000_AL_.jpg.webp.lossless.webp' 2>&1

*Output:* 
Saving file '[doc-root]/wp-content/webp-express/webp-images/doc-root/wp-content/uploads/2016/08/MV5BYzgxZjk2ZjAtNWQ2ZS00YmYzLTk5ZjUtOTBlMTc4NTc0MmVjXkEyXkFqcGdeQXVyMjMwNjE5ODY-._V1_SY1000_CR0014991000_AL_.jpg.webp.lossless.webp'
File:      [doc-root]/wp-content/uploads/2016/08/MV5BYzgxZjk2ZjAtNWQ2ZS00YmYzLTk5ZjUtOTBlMTc4NTc0MmVjXkEyXkFqcGdeQXVyMjMwNjE5ODY-._V1_SY1000_CR0014991000_AL_.jpg
Dimension: 1499 x 1000
Output:    680668 bytes (3.63 bpp)
Lossless-ARGB compressed size: 680668 bytes
  * Header size: 5932 bytes, image data size: 674711
  * Lossless features used: PREDICTION CROSS-COLOR-TRANSFORM SUBTRACT-GREEN
  * Precision Bits: histogram=5 transform=4 cache=10

Success
Reduction: -272% (went from 179 kb to 665 kb)

Picking lossy
cwebp succeeded :)

Converted image in 3701 ms, reducing file size with 37% (went from 179 kb to 113 kb)

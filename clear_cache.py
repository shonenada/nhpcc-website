from __future__ import print_function
import os
import re
from os import popen, remove
from sys import stderr


def find(path, pattern, use_full_path=False):
    """Same as GNU find tool."""
    if use_full_path:
        path = os.path.abspath(path)
    for dirpath, dirnames, filenames in os.walk(path):
        for filename in filenames:
            if re.match(pattern, filename):
                yield os.path.join(dirpath, filename)


def clean():
    """Remove all compiled opcode cache files (*.pyc)."""
    count = 0
    for cachefile in find("./nhpcc/cache/", r"^[a-zA-Z0-9_]+\.(?:php)$"):
        print("Removing %s" % cachefile)
        remove(cachefile)
        count += 1
    print("-" * 78)
    print("%d files has been removed." % count)


clean()
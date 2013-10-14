import os
from shutil import copytree


ROOT = os.path.dirname(__file__)
APP_ROOT = os.path.join(ROOT, "nhpcc")
WEB_ROOT = os.path.join(ROOT, 'wwwroot')

src_path = os.path.join(APP_ROOT, 'assets', 'components')
dst_path = os.path.join(WEB_ROOT, 'static', 'components')

copytree(src_path, dst_path)


print "Finished copying"


		menuBar_2.addItem("<?=ucwords($object_name)?>", new Command() {
			public void execute() {
				show<?=ucwords($object_name)?>Window();
			}
		});
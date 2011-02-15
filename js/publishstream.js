function publishstream(attachment, action_links) {
	FB.ui({
		method: 'stream.publish',
		message: '',
		attachment: attachment,
		action_links: action_links,
		/*attachment: {
			name: 'Connect',
			caption: 'The Facebook Connect JavaScript SDK',
			description: (
				'A small JavaScript library that allows you to harness ' +
				'the power of Facebook, bringing the user\'s identity, ' +
				'social graph and distribution power to your site.'
			),
			href: 'http://github.com/facebook/connect-js'
		},
		action_links: [{ 
			text: 'Crea Tu Liga pes', 
			href: 'http://apps.facebook.com/ligapes' 
		}],*/
		user_prompt_message: 'Que pensas?'
	}/*,

		function(response) {
			if (response && response.post_id) {
				alert('Post was published.');
			} else {
			alert('Post was not published.');
			}
		}*/
	);
};

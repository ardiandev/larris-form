/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor 54 render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */

import { useState, } from "@wordpress/element";
import { TextControl, PanelBody, ColorPalette } from "@wordpress/components"


export default function Edit(props) {

	const [name, setName] = useState("John Doe");
	const [subject, setSubject] = useState("Meeting Invitation")
	const [email, setEmail] = useState("John@johndoe.com")
	const [message, setMessage] = useState("This is example of message form.")

	const { attributes, setAttributes } = props
	const {
		nameLabel,
		subjectLabel,
		emailLabel,
		messageLabel,
	} = attributes;



	const handleInputGap = (value) => {
		setAttributes({ inputGap: value })
	}

	return (
		<>
			<InspectorControls>
				<PanelBody title="Label Text Settings" initialOpen={true}>
					<TextControl
						value={nameLabel}
						onChange={value => setAttributes({ nameLabel: value })}
					/>
					<TextControl
						value={subjectLabel}
						onChange={value => setAttributes({ subjectLabel: value })}
					/>
					<TextControl
						value={emailLabel}
						onChange={value => setAttributes({ emailLabel: value })}
					/>
					<TextControl
						value={messageLabel}
						onChange={value => setAttributes({ messageLabel: value })}
					/>
				</PanelBody>

			</InspectorControls>
			<div className="larris-contact-form" {...useBlockProps()}>
				<form className="contact-form__form" action="#">
					<ul className="contact-form__list">
						<li className="contact-form__item">
							<label className="contact-form__label" htmlFor="yourname">{nameLabel}</label>
							<input
								className="contact-form__input"
								onChange={(event) => setName(event.target.value)}
								type="text"
								id="yourname"
								name="yourname"
							/>
						</li>
						<li className="contact-form__item">
							<label className="contact-form__label" htmlFor="subject">{subjectLabel}</label>
							<input
								className="contact-form__input"
								onChange={(event) => setSubject(event.target.value)}
								type="text"
								id="subject"
								name="subject"
							/>
						</li>
						<li className="contact-form__item">
							<label className="contact-form__label" htmlFor="youremail">{emailLabel}</label>
							<input
								className="contact-form__input"
								onChange={(event) => setEmail(event.target.value)}
								id="youremail"
								name="youremail"
								type="email"
							/>
						</li>
						<li className="contact-form__item">
							<label className="contact-form__label" htmlFor="yourmessage">{messageLabel}</label>
							<textarea
								className="contact-form__textarea"
								value={message}
								onChange={(event) => setMessage(event.target.value)}
							></textarea>
						</li>
						<li className="contact-form__button_container">
							<button className="contact-form__button" disabled>Submit</button>
						</li>
					</ul>
				</form>
			</div>
		</>
	);
}

